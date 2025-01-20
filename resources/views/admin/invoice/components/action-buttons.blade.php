<a href="{{route('invoice.edit', $invoice->id)}}" class="btn btn-sm btn-outline-success btn-circle me-2 edit-product"><i class="fas fa-edit"></i></a>
    <form action="{{route('invoice.delete',$invoice->id)}}" id="deleteInvoice" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger btn-circle me-2 delete-product" ><i class="fas fa-trash"></i></button>
    </form>
<a href="{{ route('invoice.pdf', $invoice->id) }}" class="btn btn-sm btn-outline-info btn-circle"><i class="fas fa-print"></i></a>

