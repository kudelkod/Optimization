@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('optimization.calculate')}}">
        @csrf
        <div class="container mb-2 pb-2 mt-2 pt-2 border-primary">
            <div class="h2 font-family row justify-content-center mb-3 mt-2 pt-2 pb-3">
                Оптимизация запаса
            </div>
            <div class="row justify-content-center" style="font-style: italic; font-weight:normal ">D - интенсивность спроса.</div>
            <div class="row justify-content-center" style="font-style: italic; font-weight:normal ">K - затраты на оформление заказа.</div>
            <div class="row justify-content-center" style="font-style: italic; font-weight:normal ">L - срок выполнения заказа.</div>
            <div class="row justify-content-center" style="font-style: italic; font-weight:normal ">q - размер заказа для получения скидки.</div>
            <div class="row justify-content-center" style="font-style: italic; font-weight:normal ">c1 - цена без скидки.</div>
            <div class="row justify-content-center" style="font-style: italic; font-weight:normal ">c2 - цена со скидкой.</div>
            <div class="row justify-content-center" style="font-style: italic; font-weight:normal ">h - цена за хранение одного товара.</div>
            <div class="row justify-content-center">
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="form-group">
                        <label class="control-label" for="D">D</label>
                        <input id="D" name="D" type="number" class="form-control border-secondary" required min="0">
                    </div>
                </div>
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div  class="form-group">
                        <label class="control-label" for="K">K</label>
                        <input id="K" name="K" type="number" class="form-control border-secondary" required min="0">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2 border-bottom  border-primary">
                    <div class="form-group">
                        <label class="control-label" for="L">L</label>
                        <input id="L" name="L" type="number" class="form-control border-secondary" required min="0">
                    </div>
                </div>
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="form-group">
                        <label class="control-label" for="q">q</label>
                        <input id="q" name="q" type="number" class="form-control border-secondary" required min="0">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" >
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="control-group">
                        <label class="form-label" for="c1">c1</label>
                        <input id="c1" name="c1" type="number" step="0.1" class="form-control border-secondary" required min="0">
                    </div>
                </div>
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="control-group">
                        <label class="form-label" for="c2">c2</label>
                        <input id="c2" name="c2" type="number" step="0.1" class="form-control border-secondary" required min="0">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2">
                    <div class="form-group">
                        <label class="control-label" for="h">h</label>
                        <input id="h" name="h" type="number" step="0.01" class="form-control border-secondary" required min="0">
                    </div>
                </div>
                <div class="col-md-3 mt-2 mb-2 pb-2 pt-2">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-primary" type="submit">Расчитать</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
