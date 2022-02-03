<!doctype html>
<html lang="en">

<head>
    <title>Import Excel - Start Import</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/adminlte.min.css">
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        {{ $error }}
                    </div>
                @endforeach
                <div class="card">
                    <div class="card-header">

                        <div class="card-title">Start Import</div>
                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <form action="{{ url()->current() }}" method="post" id="form_import">
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Excel Header</th>
                                        <th>Table</th>
                                        <th>Column</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($headers as $index => $item)
                                        <tr id="tr_{{ $index }}">
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="hidden"
                                                            name="import[excel][row_{{ $index }}]"
                                                            id="excel_row_{{ $index }}"
                                                            value="{{ $item }}">
                                                        {{ $item }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-control" onchange="tableChanged(this,event)"
                                                    name="import[table][row_{{ $index }}]"
                                                    id="table_row_{{ $index }}">
                                                    <option value="">---</option>
                                                    @foreach ($tables as $key => $table)
                                                        <option value="{{ $table }}">{{ $table }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control"
                                                    name="import[column][row_{{ $index }}]"
                                                    id="column_row_{{ $index }}"
                                                    onchange="columnChanged(this,event,'{{ $index }}')">
                                                    <option value="">---</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <input type="hidden" value="" name="finalArray" id="finalArray">
                                </tbody>
                            </table>
                            <div class="form-group text-right px-3">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/js/adminlte.min.js"></script>
    <script>
        var formObject = {
            "tables": {}
        };

        function tableChanged(self, e) {
            const $self = $(self);
            $.ajax({
                type: "POST",
                url: "{{ url('api/import/get-columns') }}",
                data: {
                    'table': $self.val()
                },
                success: function(data) {
                    $columns = $self.parent().siblings(":last").children('select');
                    $columns.children().not(':first').remove();
                    $.each(data, function(i, v) {
                        $columns.append(
                            `<option value="${v.Field}">${v.Field}${v.Null == 'NO' ? ' -- This field is required!' : ''}</option>`
                        );
                    });
                }
            });
        }

        function columnChanged(self, e, row) {
            const $table = $(`#table_row_${row}`).val()
            const $column = $(self).val()
            const $header = $(`#excel_row_${row}`).val()


            if (formObject.tables[$table]) {
                formObject.tables[$table].push({
                    'column': $column,
                    'header': $header
                })
            } else {
                formObject.tables[$table] = [{
                    'column': $column,
                    'header': $header
                }]
            }
            $('#finalArray').val(JSON.stringify(formObject.tables))
        }
    </script>
</body>

</html>
