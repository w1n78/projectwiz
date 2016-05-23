<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display all client records.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'page_title'        => 'View All Clients',
            'navi_group'        => 'clients',
            'navi_submenu'      => 'index',
            'clients'           => Client::get()
        ];

        return view('clients.index', $data);
    }

    /**
     * Display edit form.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'page_title'        => 'Edit Client',
            'navi_group'        => 'clients',
            'navi_submenu'      => 'edit',
            'client'           => Client::find($id)
        ];

        return view('clients.edit', $data);
    }
}
