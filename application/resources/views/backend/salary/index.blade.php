@extends('backend.master')

@section('custom_style')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/jsgrid.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/datatables.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend')}}/css/lightbox.min.css">

@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Salary List <span class="float-end"><button class="btn btn-primary" id="add_customer"> <i
                                    class="fa fa-plus"></i> Pay Salary</button></span></h5>
                    <span>All Salary Information</span>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTableStyle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Salary Month</th>
                                    <th scope="col">Salary Date</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col">Bonus</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_data">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal || Start --}}
<div class="modal fade" id="CategoryEditModal" tabindex="-1" role="dialog" aria-labelledby="CategoryEditModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salary Info</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form class="" action="{{route('backend.salary.store')}}" method="POST" id="salaryAdd">
                    @csrf
                    <div class="mb-3">
                        {{-- <input id="customerID" type="hidden" name="id" value="">
                        <label class="col-form-label pt-0" for="name">Name</label> --}}
                        <label class="col-form-label pt-0" for="CategoryID">Employee Name</label>
                        <select class="form-select" id="emp_id" name="emp_id" required>
                            <option value="">-- Select a name</option>
                            @foreach ($emp_id as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="col-form-label pt-0" for="salary_month">Salary Month</label>
                            <select class="form-select" id="salary_month" name="salary_month" required>
                                <option value="">-- Select a month</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="col-form-label pt-0" for="salary_year">Salary Year</label>
                            <select class="form-select" id="salary_year" name="salary_year">
                                <option value="">-- Select a year</option>
                                @php
                                $loopYear = date('Y');
                                @endphp
                                @for ($i = $loopYear - 1; $i < $loopYear + 2; $i++) <option value="{{$i}}"
                                    {{($i == $loopYear?'selected':'')}}>{{$i}}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="col-form-label pt-0" for="salary_main">Salary</label>
                            <input class="form-control" id="salary_main" type="number" name="salary_main"
                                placeholder="Salary" disabled>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="col-form-label pt-0" for="already_paid">Already Paid</label>
                            <input class="form-control" id="already_paid" type="number" name="already_paid"
                                placeholder="Already Paid" disabled>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="payable_amount">Payable Amount</label>
                        <input class="form-control" id="payable_amount" type="number" name="payable_amount" max=""
                            placeholder="Payable Amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label pt-0" for="bonus">Bonus</label>
                        <input class="form-control" id="bonus" type="number" name="bonus" placeholder="Bonus">
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="reset" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal || End --}}
@endsection

@section('custom_script')
<!-- Plugins JS start-->
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.min.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/griddata.js"></script>
<script src="{{asset('assets/backend')}}/js/jsgrid/jsgrid.js"></script>
<!-- Plugins JS start-->
<script src="{{asset('assets/backend')}}/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/backend')}}/js/datatable/datatables/datatable.custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    $('#img_box_100').click(() => {
        $('#picture').click();
    });

    $('#add_customer').click(() => {
        $('input[type=text]').val('');
        $('input[type=number]').val('');
        $('#emp_id').val('');
        $('#CategoryEditModal').modal('show');
    });

    function getMonth() {
        const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];
        const d = new Date();
        let lastMonth = month[d.getMonth() - 1];
        var monthHtml = "";
        for (let i = 0; i < month.length; i++) {
            if (month[i] == lastMonth) {
                monthHtml += `<option value="${month[i]}" selected>${month[i]}</option>`;
            } else {
                monthHtml += `<option value="${month[i]}">${month[i]}</option>`;
            }
        }
        $('#salary_month').append(monthHtml);
    }
    getMonth();

</script>

<script>
    $('#dataTableStyle').DataTable({
        ajax: {
            url: `{{route('autosalaries')}}`,
            dataSrc: ''
        },
        columns: [{
                data: null,
                className: "text-center",
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'name'
            },
            {
                className: "text-center",
                data: 'salary_month'
            },
            {
                className: "text-center",
                data: 'salary_date'
            },
            {
                className: "text-center",
                data: 'salary'
            },
            {
                className: "text-center",
                data: 'paid_amount'
            },
            {
                className: "text-center",
                data: 'bonus'
            },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-info me-2" onclick="cat_edit('` +
                        data.id + `','` + data.name + `')"><i class="fa fa-edit"></i></button>` +
                        `<button class="border-0 btn-sm btn-danger me-2" onclick="cat_distroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
            },
        ],
        error: function (request, status, error) {
            notyf.error('No data available in table');
        }
    });

    function getsalary() {
        $.ajax({
            type: "POST",
            url: `{{route('backend.employee.getsalary')}}`,
            data: {
                "emp_id": $('#emp_id').val(),
                "salary_month": $('#salary_month').val(),
                "salary_year": $('#salary_year').val(),
            },
            success: function (data) {
                $('#salary_main').val(data.salary);
                $('#already_paid').val(data.already_paid);
                $('#payable_amount').attr('max', data.salary - data.already_paid);
                $('#payable_amount').val(data.salary - data.already_paid);
            },
            error: function (request, status, error) {
                notyf.error('Customer Delete Unsuccessfully!');
            }
        });
    }

    $('#emp_id').on('change', function () {
        getsalary();
    });

    $('#salary_month').on('change', function () {
        getsalary();
    });

    $('#salary_year').on('change', function () {
        getsalary();
    });


    function cat_edit(id) {
        $.ajax({
            type: "POST",
            url: `{{route('backend.customers.edit')}}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#customerAdd input').val();

                $('#user_pic').attr('src', `./application/uploads/customers/${data.customers.picture}`);
                $('#customerID').val(data.customers.id);
                $('#name').val(data.customers.name);
                $('#email').val(data.customers.email);
                $('#phone').val(data.customers.phone);
                $('#shopname').val(data.customers.shopname);
                $('#account_holder').val(data.customers.account_holder);
                $('#account_number').val(data.customers.account_number);
                $('#bank_name').val(data.customers.bank_name);
                $('#bank_branch').val(data.customers.bank_branch);
                $('#address').val(data.customers.address);
                $('#city').val(data.customers.city);
            },
            error: function (request, status, error) {
                notyf.error('Customer Delete Unsuccessfully!');
            }
        });
        $('#CategoryEditModal').modal('show');
    }

    function cat_distroy(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#24695c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let formUrlData = `{{route('backend.salary.destroy')}}`;
                $.ajax({
                    type: "POST",
                    url: `${formUrlData}`,
                    data: {
                        "id": id,
                    },
                    success: function (data) {
                        $('#dataTableStyle').DataTable().ajax.reload();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    },
                    error: function (request, status, error) {
                        notyf.error('Salary Delete Unsuccessfully!');
                    }
                });
            }
        });






        // let formUrlData = `{{route('backend.salary.destroy')}}`;
        // $.ajax({
        //     type: "POST",
        //     url: `${formUrlData}`,
        //     data: {
        //         "id": id,
        //     },
        //     success: function (data) {
        //         $('#dataTableStyle').DataTable().ajax.reload();
        //         notyf.success("Salary Delete Successfully!");
        //     },
        //     error: function (request, status, error) {
        //         notyf.error('Salary Delete Unsuccessfully!');
        //     }
        // });
    }

</script>

<script>
    $('#salaryAdd').on('submit', function (e) {
        e.preventDefault();
        // alert('Ho');
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                $('input[type=text]').val('');
                $('input[type=number]').val('');
                $('#emp_id').val('');
                $('#dataTableStyle').DataTable().ajax.reload();
                $('#CategoryEditModal').modal('hide');
                notyf.success("Action Successful");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });

</script>

@endsection
