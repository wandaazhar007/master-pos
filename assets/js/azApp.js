//~ Datatable serverside supplier ~//
var save_method; //for save method string
var oTable;
$(document).ready(function () {
	oTable = $('#tableSupplier').DataTable({
		"processing": true,
		"serverSide": true,
		//"lengthChange": false,
		//"displayLength" : 20,
		"order": [],
		"autoWidth": false,
		"ajax": {
			"url": base_url + "/supplier/getAllTable/",
			// "url": "http://localhost/master-pos/supplier/getAllTable/",
			"type": "POST"
		},
		"bDestroy": true,
		"aLengthMenu": [
			[10, 50, 100],
			[10, 50, 100]
		], // Combobox Limit
		"columnDefs": [{
				"targets": [0],
				"searchable": true,
				"sortable": true
			},
			{
				"targets": [1],
				"searchable": true,
				"sortable": true
			},
			{
				"targets": [2],
				"searchable": true,
				"sortable": true
			}
		],

	});
});

/* Note: Function untuk modal update supplier | Author: wandaazhar@gmail.com */
$(document).ready(function () {
	$('#tableSupplier').on('click', '.view_supplier', function () {
		var idsupplier = $(this).attr('id');
		$.ajax({
			url: base_url + "supplier/showFormUpdate",
			method: "POST",
			data: {
				idsupplier: idsupplier
			},
			success: function (data) {
				console.log('yes');
				$('#supplier_result').html(data);
				$('#modal_supplier').modal('show');
			}
		}); //end ajax
	});
});

// Note: Function untuk modal konfirmasi delete supplier using SweetAlert2 | Author: wandaazhar@gmail.com
// $(document).ready(function () {
// 	$('#tombol-delete-supplier').on('click', function () {
// 		Swal.fire({
// 			title: 'Are you sure?',
// 			text: "You won't be able to revert this!",
// 			icon: 'warning',
// 			showCancelButton: true,
// 			confirmButtonColor: '#3085d6',
// 			cancelButtonColor: '#d33',
// 			confirmButtonText: 'Yes, delete it!'
// 		}).then((result) => {
// 			if (result.value) {
// 				Swal.fire(
// 					'Deleted!',
// 					'Your file has been deleted.',
// 					'success'
// 				)
// 			}
// 		})
// 	})
// })

// $(".remove").click(function () {
// 	var id = $(this).parents("td").attr("id");

// 	swal({
// 			title: "Are you sure?",
// 			text: "You will not be able to recover this imaginary file!",
// 			type: "warning",
// 			showCancelButton: true,
// 			confirmButtonClass: "btn-danger",
// 			confirmButtonText: "Yes, delete it!",
// 			cancelButtonText: "No, cancel plx!",
// 			closeOnConfirm: false,
// 			closeOnCancel: false
// 		},
// 		function (isConfirm) {
// 			if (isConfirm) {
// 				$.ajax({
// 					url: base_url + "supplier/delete/" + id,
// 					type: 'DELETE',
// 					error: function () {
// 						alert('Something is wrong');
// 					},
// 					success: function (data) {
// 						$("#" + id).remove();
// 						swal("Deleted!", "Your imaginary file has been deleted.", "success");
// 					}
// 				});
// 			} else {
// 				swal("Cancelled", "Your imaginary file is safe :)", "error");
// 			}
// 		});

// });

$(document).ready(function () {
	$('#tableSupplier').on('click', '.view_hapus', function () {
		var idsupplier = $(this).attr('id');
		$.ajax({
			url: base_url + "supplier/showModalDelete",
			method: "POST",
			data: {
				idsupplier: idsupplier
			},
			success: function (data) {
				console.log('yes');
				$('#delete_supplier_result').html(data);
				$('#modal_delete_supplier').modal('show');
			}
		}); //end ajax
	});
});
