<div class="btn-group">
    <a href="{{ url('cuti/' . $row->id) }}" class="btn btn-sm btn-info">
        <i class="fa fa-eye"></i>
    </a>

    @if ($row->status === 'pending')
        <form action="{{ route('cuti.validasi', $row->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Setujui cuti ini?')">
                <i class="fa fa-check"></i>
            </button>
        </form>
    @endif
</div>
