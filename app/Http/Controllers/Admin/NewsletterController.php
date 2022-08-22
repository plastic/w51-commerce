<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        //TODO centralizar paginação
        $newsletter = Newsletter::where('st_ativo','!=', 'EXCLUIDO')->orderBy('dh_cadastro','desc')->paginate(2);
        return view('admin.relatorios.newsletter.index', ['newsletter' => $newsletter]);
    }

    public function search(Request $request)
    {
        // TODO criar indices no banco de dados de pesquisa
        $newsletter = Newsletter::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->orderBy('dh_cadastro','desc')
            ->paginate(15);

        return view('admin.relatorios.newsletter.index', ['newsletter' => $newsletter, 'search' => $request->search]);
    }

    public function active(Request $request)
    {
        $status = $request->status;
        $lead = Newsletter::find($request->id);
        if($status == 'INATIVO'){
            $lead->st_ativo = 'ATIVO';
        }else{
            $lead->st_ativo = 'INATIVO';
        }

        $lead->save();

        //TODO redirect mantem page
        $routeParams = [];
        if ($request->page)
        {
            $routeParams[] = $q . 'page=' . $request->page;
        }

        return redirect()->route('relatorios.newsletter',  $routeParams);
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
        $leads = Newsletter::where('st_ativo','!=', 'EXCLUIDO')->get();

        $search = $request->search;
        if($search){
            $leads = Newsletter::where('name', 'LIKE', '%' . $request->search . '%')
            ->where('st_ativo','!=', 'EXCLUIDO')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->orderBy('dh_cadastro','desc')
            ->get();
        }

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array( mb_convert_encoding('Página', "iso-8859-15"), 'Nome', 'Email', 'Data de cadastro', mb_convert_encoding('Data de ativação', "iso-8859-15"),'Sincronizado','Status');

        $callback = function() use($leads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,';');

            foreach ($leads as $lead) {
                $row['Página']  = $lead->tx_pagina;
                $row['Nome']    = mb_convert_encoding($lead->name, "iso-8859-15") ;
                $row['Email']    = $lead->email;
                $row['Data de cadastro']  = $lead->dh_cadastro;
                $row['Data de ativação']  = $lead->dh_validacao_email == '0000-00-00 00:00:00' ? '' : $lead->dh_validacao_email;
                $row['Sincronizado']  = $lead->sincronizado == 1 ? 'Sim' : 'Não';
                $row['Status']  = $lead->st_ativo;

                fputcsv($file,
                array(
                    $row['Página'],
                    $row['Nome'],
                    $row['Email'],
                    $row['Data de cadastro'],
                    $row['Data de ativação'],
                    $row['Sincronizado'],
                    $row['Status']
                ),';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }



}
