<table>
	<thead>
		<tr>
			@foreach (Auth::user()->getClientAttributes as $key=>$attribute)
			<th>{{$attribute->getCodeAttribute->name}}</th>
			@endforeach
		</tr>
	</thead>
</table>