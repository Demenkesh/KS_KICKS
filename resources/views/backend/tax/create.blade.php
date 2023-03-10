@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <span class="panel-title">{{ _lang('Create Tax') }}</span>
                </div>
                <div class="card-body">
                    <form method="post" class="validate" autocomplete="off" action="{{ route('taxes.store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Tax Class') }}</label>
                                    <input type="text" class="form-control" value="{{ old('tax_class') }}"
                                        name="tax_class" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Based On') }}</label>
                                    <select class="form-control auto-select select2"
                                        data-selected="{{ old('based_on', 'shipping_address') }}" name="based_on" required>
                                        <option value="shipping_address">{{ _lang('Shipping Address') }}</option>
                                        <option value="billing_address">{{ _lang('Billing Address') }}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tax-rates-table">
                                        <thead>
                                            <tr>
                                                <th>{{ _lang('Tax Name') }}</th>
                                                <th>{{ _lang('Country') }}</th>
                                                <th>{{ _lang('State') }}</th>
                                                <th>{{ _lang('Rate') }} %</th>
                                                <th class="text-center">{{ _lang('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="tax_name mwp-150"><input type="text" name="tax_name[]"
                                                        class="form-control" required></td>
														<td class="tax_name mwp-150"><input type="text" name="country[]"
															class="form-control" required></td>
															<td class="tax_name mwp-150"><input type="text" name="state[]"
																class="form-control" required></td>
                                                {{-- <td class="country mwp-150">
                                                    <select type="text" name="country[]" class="form-control" required>
                                                        <option value="">{{ _lang('Select Country') }}</option>
                                                        @php $supported_countries = get_option('supported_countries'); @endphp

                                                        @if (!empty($supported_countries))
                                                            @foreach (get_all_country() as $country)
                                                                @if (in_array($country->name, $supported_countries))
                                                                    <option value="{{ $country->sortname }}"
                                                                        data-id="{{ $country->id }}">
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td> --}}
                                                {{-- <td class="state mwp-150">
                                                    <select type="text" name="state[]" class="form-control">
                                                        <option value="">*</option>
                                                    </select>
                                                </td> --}}
                                                <td class="rate mwp-150"><input type="number" name="rate[]"
                                                        class="form-control" required></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-light remove-row"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="button" class="btn btn-light btn-xs float-right" id="add_new_tax_rate">
                                        <i class="fas fa-plus"></i> {{ _lang('Add New Rate') }}
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
