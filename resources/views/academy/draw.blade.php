@extends('layoutTwo.layout')

@section('title')
    Kheldhaara | Draw
@endsection

@section('content')
    <style>
        .main {
            flex-direction: column;
        }


        .byeplayers {

            display: none;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            width: 100%;
            background-color: #f6fcfb;

            padding-top: 2%;
            border-radius: 5px;
        }

        .byeplayers ul {
            padding: 3% 6%;
            width: 100%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin-top: 10px;
            gap: 4%;
            justify-content: space-between;
        }

        .byeplayers ul li {
            flex: 1 1 1;
            text-align: center;
            padding: 8px;
            background-color: #23a9de;
            color: white;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .winner {
            background-color: #28b128;
            color: white;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }

        .vs_winner {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .score_submit_btn button {
            background-color: #ff5e14;
            color: white;
            padding: 5px;
            border-radius: 5px;
            text-align: center;

        }

        .round {
            width: auto !important;
            align-items: center;
            /*
                background-color: #c4bcc496;
                */
            background-color: #23a9de;
            padding: 36px;
            margin-top: 8%;
        }

        .playermatches {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        .playermatches form {
            display: flex;
            /* align-items: center;
               */
            flex-basis: 48%;
            margin-top: 35px;
            background-color: white;
            /*background-color: #23a9de;*/

            justify-content: center;
            border-radius: 4px;
            gap: 6%;
            padding: 4px 10px;

        }

        .playermatches form span {
            /* background-color: #23a9de;
                */
            padding: 3px;
            border-radius: 5px;
            color: black;


        }

        .downloadfiles {
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 100%;
            justify-content: end;
            gap: 2%;
        }

        .downloadfiles button {
            font-size: 18px;
            background-color: white;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    <!--page-title-two-->
    <section class="page-title-two">
        <div class="title-box centred bg-color-2">
            <div class="pattern-layer">
                <div class="pattern-1"
                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-70.png') }});"></div>
                <div class="pattern-2"
                    style="background-image: url({{ asset('assets/layoutTwo/images/shape/shape-71.png') }});"></div>
            </div>
            <div class="auto-container">
                <div class="title">
                    <h1>Draw</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Draw</li>
            </ul>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- show-draw-player-list-section-start -->
    <section class="patient-dashboard bg-color-3">
        @include('layoutTwo.academySidebar')
        {{-- get stored data on the session-start --}}
        @php
            $getSessionData = Session::all();
            // $getSessionData = $getSessionData['result'];
            // dd($getSessionData);
        @endphp
        {{-- get stored data on the session-end --}}
        <div class="right-panel">
            <div class="content-container">
                <div class="outer-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form name="fetchTournamentDraw" method="post" class="mb-3">
                                @csrf
                                <select name="draw_id" id="draw_tournament" class="form-control form-select-input">
                                    <option value="">Tournament Name</option>
                                    @if (count($fetch_tournaments) > 0)
                                        @foreach ($fetch_tournaments as $index => $tournament)
                                            <option value="{{ $tournament->draw_id }}">
                                                {{ $tournament->player_num }} {{ $tournament->subCategory }}
                                                ({{ $tournament->gender }}) - {{ $tournament->tournamentName }} ({{$tournament->draw_type}})
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </form>



                            <div class="player-draw-round">
                                <h4 class="draw-info flex-basis-100"></h4>
                                <div class="main" id="playerDrawRound">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- show-draw-player-list-section-end -->
    {{-- include-draw-popup-start --}}
    @include('popup.updatePlayerStatus')
    {{-- include-draw-popup-end --}}
@endsection

@section('script')
    <script>
        // "use strict";
        document.addEventListener("DOMContentLoaded", function() {


            const showDrawToAcademyRoute = "{{ route('academy.showDrawToAcademy') }}"
            const draw_tournamentElm = document.getElementById("draw_tournament");
            const playerDrawRoundElm = document.getElementById("playerDrawRound");
            const drawInfoElm = document.querySelector(".draw-info")

            draw_tournamentElm.addEventListener("change", async function(event) {
                event.preventDefault();

                const draw_data = new FormData();
                draw_data.append('draw_id', draw_tournamentElm.value);
                //store draw id for next rounds
                localStorage.setItem('draw_id',draw_tournamentElm.value);
                try
                    {
                        let response = await fetch(showDrawToAcademyRoute, 
                        {
                            method: "POST",
                            headers: {
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            body: draw_data,
                        })
 
                        if (!response.ok) {
                            throw new Error("Response not okay! ", response.statusText);
                        }
                        let data = await response.json();
                        console.log(data);

                    drawInfoElm.innerHTML = "";
                    if (data.is_draw.length > 0) {
                        const data_is_draw = data.is_draw;
                        //store rounds value;
                        let temp = [1];
                        let j = 0;
                        for (let i = 0; i < data_is_draw.length; i++) {
                            if (data_is_draw[i].round_id != temp[j]) {
                                j++;
                                temp[j] = data_is_draw[i].round_id;
                            }
                        }

                        let category_subCategory = "";

                        // Determine the category based on subCategory
                        if (["Under 12", "Under 14", "Under 16", "Under 18"].includes(data_is_draw[0]
                                .subCategory)) {
                            category_subCategory = "Junior Category " + data_is_draw[0].subCategory;
                        } else if (["Men", "Women"].includes(data_is_draw[0].subCategory)) {
                            category_subCategory = "Senior Category " + data_is_draw[0].subCategory;
                        }

                        // Set the draw info
                        drawInfoElm.innerHTML =
                            `${data_is_draw[0].player_num} ${data_is_draw[0].gender} Tournaments ${category_subCategory} (${data_is_draw[0].draw_type}) Draw`;

                            let totEle=data_is_draw.length;
                     
                            playerDrawRoundElm.innerHTML = '';
                            for (let round = 0; round < temp.length; round++) 
                            {
                                //store byeplayers in one array and matches player in one according to round
                                let byeplayers = [];
                                let matches = [];
                                let createNextRoundbtn=true;
                                let qualifyMatch=true;
                                let interim_draw_id='';
                                for (let i = 0; i < data_is_draw.length; i++) 
                                {   
                                    let player = data_is_draw[i];
                                  
                                     interim_draw_id=player.interim_draw;
                                    //console.log(interim_draw_id);
                                    if(player.draw_type=='Main')
                                    {  
                                        qualifyMatch=false;
                                    }

                                    if(player.winner==null)
                                    {
                                        createNextRoundbtn=false;
                                    }
                                    if (player.bye === 'yes' && player.round_id==temp[round]) 
                                    {
                                        if (player.bye === 'yes') 
                                        {
                                            byeplayers.push(player);
                                        } 
                                    }
                                 else {
                                    if (player.round_id == temp[round]) {
                                        matches.push(player);
                                        }

                                    }
                                }
                                console.log(matches);
                                //checking for semi final and final round 
                                let match_roundno = matches[0].round_id;
                                if (match_roundno == 8) {
                                playerDrawRoundElm.innerHTML += ` <div class="round round-1">
                                    <h2> Semi Final</h2>
                                    <div class="byeplayers">   
                                    </div>
                                    <div class='playermatches'>       
                                    </div>
                                    </div>`;

                                } else if (match_roundno == 9) {
                                playerDrawRoundElm.innerHTML += `<div class="round round-1">
                                    <h2> Final</h2> 
                                    <div class="byeplayers">                                   
                                     </div>
                                    <div class='playermatches'> 
                                    </div>
                                    </div>`;
                                } else {
                                        playerDrawRoundElm.innerHTML += ` <div class="round round-1">
                                    
                                       
                                         <h2>Round ${round+1}   </h2>  
                                        <div class="downloadfiles">
                                       
                                       
                                        </div>
                                    <div class="byeplayers">   
                                    </div>
                                    <div class='playermatches'>                                            
                                    </div>
                                    <div class="nextRoundCreate">
                                
                                    </div>
                                    </div>`;
                                }
                                //display btn in qualify players last round
                                let lastElement = temp.slice(-1)[0];
                                if(qualifyMatch!=true ){
                                    let download=document.getElementsByClassName('downloadfiles')[round];
                                    download.innerHTML=`  <button style="color: #fc6767;"><span class="far fa-file-pdf"></span></button> 
                                         <button style="color: #28b128;"><span  class="far fa-file-excel"></span>
                                         
                                         </button>`
                                }
                                if(createNextRoundbtn==true && round+1==lastElement &&
                                   qualifyMatch==true)
                                {
                                    let NextBtnbox=document.getElementsByClassName('nextRoundCreate')[round];
                                    let lastElement = temp.slice(-1)[0];
                                    NextBtnbox.innerHTML=`    <button onclick="createNextRound(${lastElement},${interim_draw_id})">Create Next Round</button>
                                    <button onclick="MoveToMainRound(${lastElement},${interim_draw_id})">Add To Mains</button>`;
                            }
                            //display bye players in the bye player section
                            if (byeplayers.length != 0) {
                                let byeplayermain = document.getElementsByClassName('byeplayers')[
                                round];
                                byeplayermain.style.display = 'flex';
                                byeplayermain.innerHTML = `<h5>Bye players</h5>
                                            <ul class="byeplayer">
                                                
                                            </ul>`
                                let byep = document.getElementsByClassName('byeplayer')[round];
                                byep.innerHTML = '';
                                byeplayers.forEach(player => {
                                    byep.innerHTML += ` <li>${player.player_name}</li>`;
                                })
                            }
                            //store match players in the match section
                            if (matches) {

                                let matchesbox = document.getElementsByClassName("playermatches")[
                                round];
                                let j = 0;
                                //matchesbox.innerHTML=`<h5>Matches between</h5>`
                                for (let i = 0; i < matches.length; i = i + 2) {
                                    let classn = 'matchesform' + i;
                                    let classname1 = 'matchesform';
                                    if (matches[i].score != null) {
                                        let winner = matches[i + 1].player_name;

                                        if (matches[i].winner == matches[i].player_id) {
                                            winner = matches[i].player_name;
                                        }

                                        matchesbox.innerHTML += ` <form class="${classname1} ${classn}">
                                    
                                            <span style= " overflow-wrap: break-word;">${matches[i].player_name}</span>
                                            <div class="vs_winner">
                                            <img src="{{ asset('assets/images/vs.png') }}" width="30px" height="30px" ><br>
                                            <div class="winner">Winner:
                                                ${winner} 
                                            </div>
                                            </div>
                                            <span>${matches[i+1].player_name}</span>
                                        
                                            </form>`;
                                    } else {
                                        matchesbox.innerHTML += ` <form class="${classname1} ${classn}">
                                                <span style= " overflow-wrap: break-word;">${matches[i].player_name}</span>
                                                <input type="hidden" name="name1" value="${matches[i].player_name}">
                                                <input type="hidden" name="matchid" value="${matches[i].match_id}">
                                                <input type="hidden" name="player1id" value="${matches[i].player_id}">
                                                <input type="hidden" name="name2" value="${matches[i+1].player_name}" disabled>
                                                <input type="hidden" name="classno" value="${round}" >
                                                <input type="hidden" name="matchesno" value="${classn}">
                                                <input type="hidden" name="draw_type" value="${matches[i].draw_type}">
                                                <input type="hidden" name="player2id" value="${matches[i+1].player_id}">
                                                <div class="vs_winner">
                                                <img src="{{ asset('assets/images/vs.png') }}" width="30px" height="30px" ><br>
                                                <div class="score_submit_btn">
                                                <button type="button"  data-toggle="modal" data-target="#staticBackdrop" onclick="getdata(this)">
                                                    Add score
                                                </button>
                                            </div>
                                            </div>
                                            <span>${matches[i+1].player_name}</span>
                                            </form>`;
                                    }
                                }
                            }
                        }
                    }


                } catch (error) {
                    console.log('server error: ', error)
                }
            })
        })
        //get click add score btn details and pass in model
        function getdata(btndata) 
        {
            let form = btndata.closest('.matchesform');
            let player1 = form.querySelector('input[name="name1"]').value;
            let matchid = form.querySelector('input[name="matchid"]').value;
            let player2 = form.querySelector('input[name="name2"]').value;
            let playerid2 = form.querySelector('input[name="player2id"]').value;
            let playerid1 = form.querySelector('input[name="player1id"]').value;
            let classno = form.querySelector('input[name="classno"]').value;
            let matchno = form.querySelector('input[name="matchesno"]').value;

            let draw_type = form.querySelector('input[name="draw_type"]').value;
            let modelbody = document.getElementById('hiddendata');
            let score = document.getElementById('score');
            score.innerHTML = ` <p>Score*</p>
                            <input type="text" name="score" id="score" placeholder="Enter Score"
                                class="form-control update-player-status-form-text-input" value="" />
                            <p class="error" id="scoreError"></p>`;
            modelbody.innerHTML = `
            <input type="hidden" name="match_id" value="${matchid}">
                <p>Status*</p>
                            <input type="hidden" name="round" value="${classno}">
                            <input type="hidden" name="matchno" value="${matchno}">
                            <input type="hidden" name="draw_type" value="${draw_type}">  
                            <input type='hidden' name='player1name' value="${player1}"><input type='hidden' name='player2name' value="${player2}">
                            <input type="radio" name="player_id" id="player_one" value="${playerid1}" />
                            <label for="player_one" class="mr-2">${player1}</label>
                            <input type="radio" name="player_id" id="player_two" value="${playerid2}" />
                            <label for="player_two">${player2}</label>
                            <p class="error" id="statusError"></p>
                                                
            `;

        }
        //submit score from model and send to backend
        let score_update_form = document.getElementById('score_submit_form');
        //let submitscore="{{ route('academy.getMatchScore') }}";
        //let submitscore="{{ route('academy.QualifyMatchScore') }}";
        if (score_update_form) 
        {
            score_update_form.addEventListener('submit', async function(e) {
                e.preventDefault();
                let formdata = new FormData(score_update_form);
                let round = formdata.get('round');
                let matchno = formdata.get('matchno');
                try {
                    const res = await fetch(score_update_form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        },
                        body: formdata
                    });
                    const data = await res.json();
                    if (res.ok) {
                        console.log(data);

                        let winner = data.winner;
                        Swal.fire({
                            title:"Success",
                            text:"score submitted successfully",
                            icon:"success"
                        })
                   
                        let round = formdata.get('round');
                        let player1 = formdata.get('player1name');
                        let player2 = formdata.get('player2name');
                        let element = document.getElementsByClassName('playermatches')[round];
                      
                        let form = element.querySelector(`.${matchno}`);
                        console.log(form);
                        // update winner
                        form.innerHTML = ` 
                                    
                                    <span style= " overflow-wrap: break-word;">${player1}</span>
                                    <div class="vs_winner">
                                    <img src="{{ asset('assets/images/vs.png') }}" width="30px" height="30px" ><br>
                                    <div class="winner">Winner:
                                                ${winner}
                                    </div>
                                    </div>
                                    <span>${player2}</span>     
                               `;
                        //hide model
                        $('#staticBackdrop').modal('hide');
                        //get select tournament from local storage
                        $drawid = localStorage.getItem('draw_id');
                        console.log($drawid);


                        if (data.newround) {
                            if (data.newround == 'true') {
                                Swal.fire({
                                title:"Success",
                                text: "Next Round created successfully",
                                icon:"success"
                                })
                                const draw_tournamentElm = document.getElementById("draw_tournament");

                                // Change the value of the dropdown
                                draw_tournamentElm.value = $drawid;
                                const event = new Event('change', {
                                    bubbles: true,
                                    cancelable: true
                                });

                                draw_tournamentElm.dispatchEvent(event);
                            }
                        }
                    } else {
                        alert('something went wrong');
                    }
                } catch (err) {
                    console.log(err);
                }


            })
        }


        //qualifying create and move to next , main round logic
        function MoveToMainRound(lastround, interim_draw_id) {
            let route = "{{ route('academy.moveToMainDraw') }}"
            if (lastround == 1) {
                lastround = 'roundOne';
            }
            if(lastround==2){
                lastround='roundTwo';
            }
            if(lastround==3){
                lastround='roundthree';
            }
            if(lastround==4){
                lastround='roundfour';
            }
            if(lastround==5){
                lastround='roundFive';
            }
            if(lastround==6){
                lastround='roundSix';
            }
            if(lastround==7){
                lasetround='semifinal'
            }
            if(lastround==8)
            {
                lastround='final';
            }


            let params=`${route}?interim_draw_id=${interim_draw_id}&last_round=${lastround}`;
            window.location.href=params;

        }

        function createNextRound(lastround, interim_draw_id) {
            let route = "{{ route('academy.nextQualifyRound') }}"
            if (lastround == 1) {
                lastround = 'roundOne';
            }
            if(lastround==2){
                lastround='roundTwo';}
           
            if(lastround==3){
                lastround='roundthree';
            }
            if(lastround==4){
                lastround='roundfour';
            }
            if(lastround==5){
                lastround='roundFive';
            }
            if(lastround==6){
                lastround='roundSix';
            }
            if(lastround==7){
                lasetround='semifinal'
            }
            if(lastround==8)
            {
                lastround='final';
            }


            let params=`${route}?interim_draw_id=${interim_draw_id}&round=${lastround}`;
                try{
                        let res=fetch(params);
                        res.then((response)=>{
                           if(!response){
                            throw new Error('there is issue'+ response.error);
                           }
                           return response.json();
                        }).then((res)=>{
                            console.log(res);
                            Swal.fire({
                                title:"Success",
                                text: res.msg,
                                icon:"success"
                                })
                            $drawid = localStorage.getItem('draw_id');
                            console.log($drawid);

                            const draw_tournamentElm = document.getElementById("draw_tournament");

                                // Change the value of the dropdown
                                draw_tournamentElm.value = $drawid;
                                const event = new Event('change', {
                                    bubbles: true,
                                    cancelable: true
                                });

                                draw_tournamentElm.dispatchEvent(event);
                        })       
                        //window.location.href=params;
                }catch(err){
                        console.log(err);
                }

        }
    </script>
@endsection
