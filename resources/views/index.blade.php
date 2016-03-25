<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<h1>Data Entry</h1>
	<div>
		<form class="form-horizontal" method="post" id="add_form" action="{{ URL::to('/add_product') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Product name</label>
		    <div class="col-sm-10">
		      <input type="text" name="product_name" class="form-control" id="inputEmail3" placeholder="Product name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Quantity in stock</label>
		    <div class="col-sm-10">
		      <input type="number" name="product_quantity" class="form-control" id="inputPassword3" placeholder="Quantity in stock">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Price per item</label>
		    <div class="col-sm-10">
		      <input type="number" name="product_price"class="form-control" id="inputPassword3" placeholder="Quantity in stock">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Add Product</button>
		    </div>
		  </div>
		</form>
	</div>



	<table id="example" class="table" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Created</th>
                <th>Total</th>
            </tr>
        </thead>
    </table>
</div>

<script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript">
	$("#add_form").submit(function(event) {
		var data = $(this).serializeArray();
		console.log(data);
		$.ajax({
			type: "post",
			url: $(this).attr('action'),
			data: data,
			success: function( a, b ) {
				console.log(a);
				console.log(b);
				location.reload();
			}
		});

		event.preventDefault();
	});

	$('#example').DataTable( {
        "ajax": "{{ URL::to('/get_all') }}",
        bFilter: false,
        bInfo : false,
        "bLengthChange": false,
        bPaginate: false,
        aaSorting: [3, 'desc'],
        "columns": [
            { "data": "product_name" },
            { "data": "product_quantity" },
            { "data": "product_price" },
            { "data": "date_submitted" },
            { "data": "total_value_number" }
        ]
    } );
</script>
</body>
</html>