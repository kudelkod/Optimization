@extends('layouts.app')
@section('content')
    <form method="get" action="{{route('optimization.index')}}">
        <div class="container mb-2 pb-2 mt-2 pt-2 border-primary">
            <div class="row justify-content-center">
                <div class="col-md-2 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="form-group">
                        <label for="D">D</label>
                        <input id="D" name="D" value="{{$item->D}}" type="text" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-md-2 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="form-group">
                        <label for="K">K</label>
                        <input id="K" name="K" value="{{$item->K}}" type="text" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-md-2 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="form-group">
                        <label for="L">L</label>
                        <input id="L" name="L" value="{{$item->L}}" type="text" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-md-2 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="form-group">
                        <label for="q">q</label>
                        <input id="q" name="q" value="{{$item->q}}" type="text" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-sm-2 mt-2 mb-2 pb-2 pt-2 border-bottom border-primary">
                    <div class="form-group">
                        <br>
                        <button class="bnt btn-primary form-control" type="submit" >Вернуться</button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="c1">c1</label>
                        <input id="c1" name="c1" value="{{$item->c1}}" type="text" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="c2">c2</label>
                        <input id="c2" name="c2" value="{{$item->c2}}" type="text" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="h">h</label>
                        <input id="h" name="h" type="text" value="{{$item->h}}" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="y">y</label>
                        <input id="y" name="y" value="{{round($item->y)}}" type="text" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div style="font-style: italic; font-weight:normal ">Оптимальная стратегия заказа товара: Заказать {{round($item->y)}} товаров, как только их запас уменьшится до {{round($item->result)}}</div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-group">
                        <canvas id="myChart"></canvas>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/chart.js"></script>
                        <!--<script src="myChart.js"></script>-->
                        <script>
                            function compareNumbers(a, b) {
                                return a - b;
                            }

                            function getMaxOfArray(array){
                                return Math.max.apply(null, array);
                            }
                            function getMinOfArray(array){
                                return Math.min.apply(null, array);
                            }
                            // === include 'setup' then 'config' above ===
                            let yobj = @json($item->y);
                            let y = Number(yobj);
                            let Dobj = @json($item->D);
                            let D = Number(Dobj);
                            let c1obj = @json($item->c1);
                            let c1 = Number(c1obj);
                            let c2obj = @json($item->c2);
                            let c2 = Number(c2obj);
                            let Kobj = @json($item->K);
                            let K = Number(Kobj);
                            let hobj = @json($item->h);
                            let h = Number(hobj);
                            let Ymobj = @json($item->Ym);
                            let Ym = Number(Ymobj);
                            let Qobj = @json($item->Q);
                            let Q = Number(Qobj);
                            let qobj = @json($item->q);
                            let q = Number(qobj);

                            let array = [Ym, Q, q];
                            let max = getMaxOfArray(array);
                            let min = getMinOfArray(array);
                            array.push(max+(min)/2);
                            array.push(min-(min)/2)
                            array.sort(compareNumbers);

                            let Y = [];
                            for (let i =1; i<=y ; i++){
                                Y.push(i);
                            }

                            let TCU_1 =[];
                            for (let i = 0; i<array.length; i++ ){
                                TCU_1.push((D *c1 + ((K * D)/array[i]) + (h/2) * array[i]));
                            }

                            let TCU_2 = [];
                            for (let i = 0; i<array.length; i++ ){
                                TCU_2.push((D *c2 + ((K * D)/array[i]) + (h/2) * array[i]));
                            }

                            let arrayLabel = [min-(min)/2,'q: '+q, 'Ym: '+Ym, 'Q: '+Q,max+(min)/2];
                            if(Ym<=q && q<=Q){
                                arrayLabel = [min-(min)/2,'Ym: '+Ym, 'q: '+q, 'Q: '+Q,max+(min)/2];
                            }
                            if(q >= Q){
                                arrayLabel= [min-(min)/2,'Ym: '+Ym, 'Q: '+Q, 'q: '+q,max+(min)/2];
                            }

                            const data = {
                                labels: arrayLabel,
                                datasets: [{
                                    axis: 'y',
                                    fill:false,
                                    tension: 0.1,
                                    label: 'TCU1',
                                    backgroundColor: 'rgb(5, 130, 150)',
                                    borderColor: 'rgb(5, 130, 150)',
                                    data: TCU_1,Q, q, Ym
                                },
                                    {
                                        axis: 'y',
                                        fill:false,
                                        tension: 0.1,
                                        label: 'TCU2',
                                        backgroundColor: 'rgb(255, 10, 132)',
                                        borderColor: 'rgb(255, 10, 132)',
                                        data: TCU_2,Q, q, Ym
                                    }]
                            };
                            const config = {
                                type: 'line',
                                data: data,
                                options: {options: {
                                    }
                                }
                            };
                            const myChart = new Chart(
                                document.getElementById('myChart'),
                                config
                            );
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
