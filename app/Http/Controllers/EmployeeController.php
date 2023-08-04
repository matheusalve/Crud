<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller {

    // exibe a página inicial com a lista de funcionários
    public function index() {
        $employees = Employee::all();
        return view('home', compact('employees'));
    }

    // exibe o formulário de criação de funcionário
    public function create() {
        return view('create_employee');
    }

    // armazena um novo funcionário no banco de dados
    public function store(Request $request) {
        // Validação dos dados do formulário aqui
        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Funcionário adicionado com sucesso!');
    }

    // exibe o formulário de edição de funcionário
    public function edit($id) {
        $employee = Employee::findOrFail($id);
        return view('edit_employee', compact('employee'));
    }

    // atualiza os dados de um funcionário
    public function update(Request $request, $id) {
        $employee = Employee::findOrFail($id);
        // Validação dos dados do formulário aqui
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    // exclui um funcionário
    public function destroy($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Funcionário excluído com sucesso!');
    }
}
