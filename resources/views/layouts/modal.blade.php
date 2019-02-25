<div class="modal fade" id="bookStatusModal" tabindex="-1" role="dialog" aria-labelledby="bookStatusModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-capitalize" id="bookStatusModalLabel">{{ $action }} Book</h4>
			</div>
			<div class="modal-body">
				<p>
					Please confirm you would like to {{ $action }} the book: 
					<b><span id="book-title">{{ $book->name }}</span></b>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<span class="pull-right" style="margin-left: 10px;">
					<form action="{{ route('book.'.$action, ['book' => $book]) }}" method="post">
						<input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}
						<input type="submit" value="{{ $action }} this book" class="btn btn-primary text-capitalize" />
					</form>
				</span>
			</div>
		</div>
	</div>
</div>