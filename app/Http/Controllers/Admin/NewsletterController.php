<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletter = Newsletter::paginate(15);
        return view('admin.relatorios.newsletter.index', ['newsletter' => $newsletter]);
    }

    public function search(Request $request)
    {
        $newsletter = Newsletter::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->paginate(15);

        return view('admin.relatorios.newsletter.index', ['newsletter' => $newsletter]);
    }

    public function active(Request $request)
    {
        $lead = Newsletter::find($request->id);
        $lead->st_ativo = 'ATIVO';
        $lead->save();

        $newsletter = Newsletter::paginate(15);
        return view('admin.relatorios.newsletter.index', ['newsletter' => $newsletter]);
    }
    public function delete(Request $request)
    {
        $lead = Newsletter::find($request->id);
        $lead->st_ativo = 'EXCLUIDO';
        $lead->save();

        $newsletter = Newsletter::paginate(15);
        return view('admin.relatorios.newsletter.index', ['newsletter' => $newsletter]);
    }

    public function export(Request $request)
    {
        $fileName = 'newsletter-'.str_replace(' ', '_', now()).'.csv';
        $leads = Newsletter::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array( mb_convert_encoding('Página', "iso-8859-15"), 'Nome', 'Email', 'Data de cadastro', mb_convert_encoding('Data de validação', "iso-8859-15"),'Sincronizado','Status');

        $callback = function() use($leads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,';');

            foreach ($leads as $lead) {
                $row['Página']  = $lead->tx_pagina;
                $row['Nome']    = mb_convert_encoding($lead->name, "iso-8859-15") ;
                $row['Email']    = $lead->email;
                $row['Data de cadastro']  = $lead->dh_cadastro;
                $row['Data de validação']  = $lead->dh_validacao_email;
                $row['Sincronizado']  = $lead->sincronizado;
                $row['Status']  = $lead->st_ativo;

                fputcsv($file,
                array(
                    $row['Página'],
                    $row['Nome'],
                    $row['Email'],
                    $row['Data de cadastro'],
                    $row['Data de validação'],
                    $row['Sincronizado'],
                    $row['Status']
                ),';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


}
