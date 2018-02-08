
@extends('layouts.app')



@section('title') Home :: Translate @parent @endsection

@section('content')

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="input">Input:</label>
                                <div class="btn-group" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default" id="btn-input" value="ja">Japanese</button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="btn-exchange" class="btn btn-default pull-right" onclick="exchage_language()"><span class="glyphicon glyphicon-resize-horizontal"></span></button>
                            </div>
                        </div>
                        <textarea class="form-control" rows="15" id="input" placeholder="Enter here ..."></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="output">Output:</label>
                                <div class="btn-group" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default" id="btn-output" value="vi">Vietnamese</button>
                                </div>
                            </div>
                        </div>
                        <textarea class="form-control" rows="15" id="output" disabled="disabled"></textarea>
                    </div>
                </div>
            </div>

        </div>
        
        <div class = "capatcha">
            <div class="g-recaptcha" data-sitekey="{!! Config::get('configserver.recaptcha'); !!}"></div>
            <!-- <div class="g-recaptcha" data-sitekey="6LdzbjQUAAAAAEiIA9MnLU4TJRvkbAWPdZhofHzN"></div> -->
            <span id = "captcha"></span>
        </div>
        <div class="checkbox text-center" >
            <button type="button" class="btn btn-default btn-lg" id = "translate">Translate</button>
            <!-- <button type="button" class="btn btn-primary btn-lg" id="translate" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order"><i class="fa fa-circle-o-notch fa-spin"></i>Translate</button> -->
            
        </div>
        
    </section>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/translate-guest.js') }}"></script>
@endsection
@section('styles')
<style>
    .capatcha {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }
</style>
@endsection