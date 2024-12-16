@if(isset($product))
    <tr id="row_{{ $product->id }}">
        <td class="serial"></td>
        <td class="col-5">
            <input type="hidden" name="product_id[]" value="{{ $product->id }}" class="form-control product_id">
            <input type="text" name="product_name[]" value="{{ $product->name ?? "" }}" class="form-control" readonly required>
            <br>
            <textarea placeholder="Description" name="description[]"  class="form-control" required rows="1" placeholder="Short Description" ></textarea>
        </td>
        <td class="col-2">
            <input type="text" name="unit_price[]"  value="{{ $product->unit_price ?? 0 }}" class="form-control unit_price" required placeholder="Unit Price">
        </td>
        <td class="col-2">
            <input type="text" name="quantity[]" value="1" class="form-control quantity" placeholder="Quantity" required min="1">
        </td>
        <td class="col-2">
            <input type="text" name="amount[]" value="{{ $product->unit_price ?? 0 }}" class="form-control amount" readonly placeholder="Total" required>
        </td>
        <td class="col-1">
            <button type="button" class="btn btn-md btn-danger ds_remove_row" data-id="{{ $product->id }}">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
@endif