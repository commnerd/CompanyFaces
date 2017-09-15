<form method="POST" class="inline" action="{{ route('admin.'.$context.'.destroy', [$context => $entity]) }}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE" />
    <a href="#delete" class="fa fa-times fa-2x" aria-hidden="true" title="Delete"></a>
</form>
