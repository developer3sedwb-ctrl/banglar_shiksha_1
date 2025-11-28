@extends('layouts.app')

@section('title', 'Total Teacher')

@section('content')
<div @class(['container-fluid', 'px-4' ])> <!-- full-width container -->
    <div @class(['row'])>
        <div @class(['col-lg-8', 'mb-5' ])>
            <div @class(['card'])>
                <div @class(['d-flex', 'align-items-center' , 'row' ])>
                    <div @class(['col-sm-7'])>
                        <div @class(['card-body', 'pb-5' , 'institution-details' ])>
                            <p @class(['text-secondary', 'mb-2' , 'd-block' ])>{{$data['user_role']}}</p>
                            <h4 @class(['text-primary', 'mb-2' ])><strong>{{$data['user_circle']}}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div @class(['row', 'g-4'])>

    

</div>

</div>

@endsection