<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::paginate(10);
        return view('expense.index', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expense.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'inputDate'   => 'required',
                'inputAmount' => 'required',
                'inputType'   => 'required',
            ]);
            $date    = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDate'))));
            $expense = new Expense([
                'date'   => $date,
                'amount' => str_replace(',', '', $request->get('inputAmount')),
                'type'   => $request->get('inputType'),
                'note'   => $request->get('inputNote'),
            ]);
            $expense->save();
            return redirect('/admin/expense');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('patch')) {
            $request->validate([
                'inputDate'   => 'required',
                'inputAmount' => 'required',
                'inputType'   => 'required',
            ]);
            $date            = date('Y-m-d', strtotime(str_replace('/', '-', $request->get('inputDate'))));
            $expense         = Expense::find($id);
            $expense->date   = $date;
            $expense->amount = str_replace(',', '', $request->get('inputAmount'));
            $expense->type   = $request->get('inputType');
            $expense->note   = $request->get('inputNote');
            $expense->update();
            return redirect('/admin/expense');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect('/admin/expense');
    }
}
