<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'purchase_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],

            'product_ids' => ['required', 'array', 'min:1'],
            'product_ids.*' => ['required', 'integer', 'distinct', 'exists:products,id'],

            'quantities' => ['required', 'array', 'min:1'],
            'quantities.*' => ['required', 'integer', 'min:1'],

            'unit_costs' => ['required', 'array', 'min:1'],
            'unit_costs.*' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'supplier_id.required' => 'Supplier wajib dipilih.',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid.',
            'purchase_date.required' => 'Tanggal pembelian wajib diisi.',
            'product_ids.required' => 'Pilih minimal satu produk.',
            'product_ids.*.distinct' => 'Produk yang sama tidak boleh dipilih lebih dari sekali.',
            'quantities.*.min' => 'Jumlah barang minimal 1.',
            'unit_costs.*.min' => 'Harga modal tidak boleh negatif.',
        ];
    }
}
