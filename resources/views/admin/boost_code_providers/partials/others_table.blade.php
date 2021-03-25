<table class="table table-striped table-hover table-bordered" id="others-table">
    <thead>
    <tr role="row">
        <th>
            Image
        </th>
        <th>
            Name
        </th>
        <th>
            Credits Left
        </th>
        <th>
            Credits Total
        </th>
        <th>
            Commission Rate
        </th>
        <th>
            Options
        </th>
    </tr>
    </thead>
    <tbody>
    @if(isset($others))
        @foreach($others as $boost_code_provider)
            <tr role="row">
                <td>
                    <img src="{{getImageUrl(basename($boost_code_provider['image']),\App\Models\Admin\BoostCodeProvider::IMAGE_PATH)}}"
                         width="120">
                </td>
                <td>{{$boost_code_provider['name']}}</td>
                <td>{{$boost_code_provider['credits_left']}}</td>
                <td>{{$boost_code_provider['credits_total']}}</td>
                <td>{{$boost_code_provider['commission_rate']}}%</td>
                <td>
                    <a href="{{route('boost_code_providers.edit',$boost_code_provider['id'])}}"
                       class="btn btn-info btn-xs edit">
                        <i class="fa fa-edit"></i> Edit</a>
                    {!!displayDeleteForm(route('boost_code_providers.destroy',$boost_code_provider['id']))!!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>

</table>