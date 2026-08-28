<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    /**
     * Display expense list.
     */
    public function index()
    {
        $libraryId = auth()->user()->library_id;

        $search = trim(request('search', ''));

        $category = request('category');

        $paymentMode = request('payment_mode');

        $date = request('date');

        /*
        |--------------------------------------------------------------------------
        | Expenses
        |--------------------------------------------------------------------------
        */

        $expenses = Expense::where('library_id', $libraryId)
            ->with([
                'creator',
            ])

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'expense_no',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'title',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'category',
                        'like',
                        "%{$search}%"
                    );
                });
            })

            ->when($category, function ($query) use ($category) {

                $query->where(
                    'category',
                    $category
                );
            })

            ->when($paymentMode, function ($query) use ($paymentMode) {

                $query->where(
                    'payment_mode',
                    $paymentMode
                );
            })

            ->when($date, function ($query) use ($date) {

                $query->whereDate(
                    'expense_date',
                    $date
                );
            })

            ->latest('expense_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Expense Statistics
        |--------------------------------------------------------------------------
        */

        $todayExpense = Expense::where('library_id', $libraryId)
            ->whereDate(
                'expense_date',
                today()
            )
            ->sum('amount');

        $monthExpense = Expense::where('library_id', $libraryId)
            ->whereMonth(
                'expense_date',
                now()->month
            )
            ->whereYear(
                'expense_date',
                now()->year
            )
            ->sum('amount');

        $totalExpense = Expense::where('library_id', $libraryId)
            ->sum('amount');

        $todayExpenseCount = Expense::where('library_id', $libraryId)
            ->whereDate(
                'expense_date',
                today()
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Expense::query()
            ->where('library_id', $libraryId)
            ->select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        /*
        |--------------------------------------------------------------------------
        | Send Data To View
        |--------------------------------------------------------------------------
        */

        return view('expenses.index', compact(
            'expenses',
            'todayExpense',
            'monthExpense',
            'totalExpense',
            'todayExpenseCount',
            'categories'
        ));
    }

    /**
     * Show create expense form.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Show edit expense form.
     */
    public function edit(Expense $expense)
    {
        abort_unless(
            $expense->library_id === auth()->user()->library_id,
            404
        );

        return view(
            'expenses.edit',
            compact('expense')
        );
    }

    /**
     * Store expense.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'payment_mode' => [
                'required',
                'in:Cash,UPI,Card,Bank Transfer',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Expense
        |--------------------------------------------------------------------------
        */

        Expense::create([

            'library_id' =>
                auth()->user()->library_id,

            'expense_no' =>
                $this->generateExpenseNumber(),

            'title' =>
                $validated['title'],

            'amount' =>
                $validated['amount'],

            'expense_date' =>
                $validated['expense_date'],

            'category' =>
                $validated['category'],

            'description' =>
                $validated['description'] ?? null,

            'payment_mode' =>
                $validated['payment_mode'],

            'created_by' =>
                auth()->id(),
        ]);

        return redirect()
            ->route('expenses.index')
            ->with(
                'success',
                'Expense added successfully.'
            );
    }

    /**
     * Update expense.
     */
    public function update(Request $request, Expense $expense)
    {
        abort_unless(
            $expense->library_id === auth()->user()->library_id,
            404
        );

        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'payment_mode' => [
                'required',
                'in:Cash,UPI,Card,Bank Transfer',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Expense
        |--------------------------------------------------------------------------
        */

        $expense->update([

            'title' =>
                $validated['title'],

            'amount' =>
                $validated['amount'],

            'expense_date' =>
                $validated['expense_date'],

            'category' =>
                $validated['category'],

            'description' =>
                $validated['description'] ?? null,

            'payment_mode' =>
                $validated['payment_mode'],

            'updated_by' =>
                auth()->id(),
        ]);

        return redirect()
            ->route('expenses.index')
            ->with(
                'success',
                'Expense updated successfully.'
            );
    }

    /**
     * Delete expense.
     */
    public function destroy(Expense $expense)
    {
        abort_unless(
            $expense->library_id === auth()->user()->library_id,
            404
        );

        $expense->update([
            'updated_by' => auth()->id(),
        ]);

        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with(
                'success',
                'Expense deleted successfully.'
            );
    }

    /**
     * Generate unique expense number.
     */
    private function generateExpenseNumber(): string
    {
        $libraryId = auth()->user()->library_id;

        do {

            $expenseNo =
                'EXP-' .
                now()->format('Ym') .
                '-' .
                strtoupper(
                    Str::random(6)
                );

        } while (
            Expense::where('library_id', $libraryId)
                ->where('expense_no', $expenseNo)
                ->exists()
        );

        return $expenseNo;
    }
}