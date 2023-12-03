<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PartnerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('partner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partner.index');
    }

    public function create()
    {
        abort_if(Gate::denies('partner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partner.create');
    }

    public function edit(Partner $partner)
    {
        abort_if(Gate::denies('partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partner.edit', compact('partner'));
    }

    public function show(Partner $partner)
    {
        abort_if(Gate::denies('partner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partner.show', compact('partner'));
    }
}
