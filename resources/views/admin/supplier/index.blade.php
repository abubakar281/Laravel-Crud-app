<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b style="color: red;"><i class="fas fa-industry"></i></i>&nbsp; Suppliers!</b>
            <b style="float: right;">Total Suppliers: <span><i class="fas fa-industry"></i></span>
                <span class="badge rounded-pill badge-notification bg-danger" style="color: #fff;">{{count($suppliers_count)}}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-dark text-white border-primary">
                        <div class="card-header bg-primary"> Add Suppliers </div>
                        <div class="card-body">
                            <form action="{{ route('store.supplier') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="supplier_name">Supplier Name</label>
                                    <input type="text" name="supplier_name" class="form-control">

                                    @error('supplier_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror


                                </div>
                                <div class="form-group">
                                    <label for="supplier_image">Supplier Logo</label>
                                    <input type="file" name="supplier_image" class="form-control">

                                    @error('supplier_image')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror


                                </div>

                                <button type="submit" class="btn btn-primary">Add Suppliers</button>
                            </form>

                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card bg-dark text-white border-primary">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-thumbs-up"></i> {{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="card-header border-primary bg-primary"> Suppliers Details! </div>
                        <div class="card-body">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supplier Name</th>
                                        <th scope="col">Supplier Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php($i = 1)
                                    @foreach($suppliers as $supplier)
                                    <tr>
                                        <!-- <th scope="row">{{-- {{$i++}}--}} </th> -->
                                        <th scope="row"> {{$suppliers->firstItem()+$loop->index}} </th>
                                        <td> {{ $supplier->supplier_name }} </td>
                                        <td> <img src="{{ asset($supplier->supplier_image) }}" style="width: 40px; height: 40px;"> </td>
                                        <td>
                                            @if($supplier->created_at == NULL)
                                            <span class="text-danger"> No Date Set</span>
                                            @else
                                            {{ $supplier->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/supplier/edit/'.$supplier->id)}}" class="btn btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="{{url('/supplier/delete/'.$supplier->id)}}" onclick="return confirm('Are you want to delete!')" class="btn btn-danger" title="Soft Delete"><i class="fas fa-trash-alt"></i></a>
                                        </td>


                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfooter>

                                </tfooter>
                            </table>
                            <div class="card-footer bg-transparent border-success text-light">{{$suppliers->links()}}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
</x-app-layout>