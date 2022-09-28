@extends('admin.layouts.master')

@section('title', 'Feedbacks')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">User Feedbacks</h2>
                        </div>
                    </div>
                </div>
                <!-- Looping Users list -->
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($feedbacks) != 0)
                                @foreach ($feedbacks as $f)
                                    <tr class="tr-shadow">
                                        <td>{{ $f->name }}</td>
                                        <td class="desc">{{ $f->email }}</td>
                                        <td>{{ $f->phone }}</td>
                                        <td>{{ $f->message }}</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    <strong>There is no user feedback.</strong>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
@endsection
