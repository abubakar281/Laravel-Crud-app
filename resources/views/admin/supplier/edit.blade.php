<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b style="color: red;"><i class="far fa-folder-open"></i>&nbsp;Update Supplier Details</b>
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto ">
                    <div class="card bg-dark text-white border-primary">
                        <div class="card-header bg-primary"> Update Supplier </div>
                        <div class="card-body">
                            <form action="{{ url('supplier/update/'.$suppliers->id)  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="previous_image" value="{{ $suppliers->supplier_image}}">
                                <div class="form-group">
                                    <label for="">Update Supplier Name</label>
                                    <input type="text" name="supplier_name" class="form-control" value="{{ $suppliers->supplier_name }}">

                                    @error('supplier_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror


                                </div>
                                <div class="form-group">
                                    <label for="">Update Supplier Image</label>
                                    <input type="file" name="supplier_image" class="form-control" value="{{ $suppliers->supplier_image}}">

                                    @error('supplier_image')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror


                                </div>
                                <div class="form-group">
                                    <img src="{{asset($suppliers->supplier_image)}}" style="width:  200px; height: 200px;">
                                </div>


                                <button type="submit" class="btn btn-primary">Update Supplier Details</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>