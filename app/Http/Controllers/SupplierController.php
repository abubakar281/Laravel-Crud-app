<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class SupplierController extends Controller
{
    public function AllSupplier()
    {
        $suppliers_count = Supplier::all();
        $suppliers = Supplier::latest()->paginate(4);
        return view('admin.supplier.index', compact('suppliers', 'suppliers_count'));
    }

    public function StoreSupplier(Request $request)
    {
        $validatedData = $request->validate(
            [
                'supplier_name' => 'required|unique:suppliers|min:4',
                'supplier_image' => 'required|mimes:jpg.jpeg,png',

            ],
            [
                'supplier_name.required' => 'Please Input Supplier Name',
                'supplier_image.min' => 'Supplier Name Longer Then 4 Characters',
            ]
        );

        $supplier_image =  $request->file('supplier_image');

        $random_name = hexdec(uniqid());
        $input_img_ext = strtolower($supplier_image->getClientOriginalExtension());
        $uni_img_name = $random_name . '.' . $input_img_ext;
        $upload_loc = 'images/supplier/';
        $hosted_img = $upload_loc . $uni_img_name;
        $supplier_image->move($upload_loc, $uni_img_name);


        Supplier::insert([
            'supplier_name' => $request->supplier_name,
            'supplier_image' => $hosted_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }


    public function EditSupp($id)
    {
        $suppliers = Supplier::find($id);
        return view('admin.supplier.edit', compact('suppliers'));
    }

    public function UpdateSupp(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'supplier_name' => 'required|min:4',
            ],
            [
                'supplier_name.required' => 'Please Input Supplier Name',
                'supplier_image.min' => 'Supplier Name Longer Then 4 Characters',
            ]
        );

        $previous_image = $request->previous_image; // hidden field
        $supplier_image =  $request->file('supplier_image'); // new upload image

        if ($supplier_image) {
            $random_name = hexdec(uniqid());
            $input_img_ext = strtolower($supplier_image->getClientOriginalExtension());
            $uni_img_name = $random_name . '.' . $input_img_ext;
            $upload_loc = 'images/supplier/';
            $hosted_img = $upload_loc . $uni_img_name;
            $supplier_image->move($upload_loc, $uni_img_name);

            unlink($previous_image);
            Supplier::find($id)->update([
                'supplier_name' => $request->supplier_name,
                'supplier_image' => $hosted_img,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Supplier information Updated Successfully!',
                'alert-type' => 'success'
            );

            return Redirect()->route('all.supplier')->with($notification);
        } else {

            Supplier::find($id)->update([
                'supplier_name' => $request->supplier_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Supplier information Updated Successfully!',
                'alert-type' => 'success'
            );

            return Redirect()->route('all.supplier')->with($notification);
        }
    }

    public function DeleteSupp($id)
    {
        $supplier_id = Supplier::find($id);
        $unlink_id = $supplier_id->supplier_image;
        unlink($unlink_id);

        Supplier::find($id)->delete();
        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}
