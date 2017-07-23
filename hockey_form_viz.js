  <script type="text/javascript">
    var player_name1 = <?php echo json_encode($echo1['player_name1']); ?>; 
    var player_name2 = <?php echo json_encode($echo2['player_name2']); ?>; 
    //pull games
    var p1_Gm_1617 = <?php echo json_encode($echo1['Gm_1617']); ?>; 
    var p1_Gm_1516 = <?php echo json_encode($echo1['Gm_1516']); ?>; 
    var p2_Gm_1617 = <?php echo json_encode($echo2['Gm_1617']); ?>; 
    var p2_Gm_1516 = <?php echo json_encode($echo2['Gm_1516']); ?>; 
    //pull goals
    var p1_G60_EV_1617 = <?php echo json_encode($echo1['G60_EV_1617']); ?>; 
    var p1_G60_EV_1516 = <?php echo json_encode($echo1['G60_EV_1516']); ?>; 
    var p1_G60_PP_1617 = <?php echo json_encode($echo1['G60_PP_1617']); ?>; 
    var p1_G60_PP_1516 = <?php echo json_encode($echo1['G60_PP_1516']); ?>; 

    var p2_G60_EV_1617 = <?php echo json_encode($echo2['G60_EV_1617']); ?>; 
    var p2_G60_EV_1516 = <?php echo json_encode($echo2['G60_EV_1516']); ?>; 
    var p2_G60_PP_1617 = <?php echo json_encode($echo2['G60_PP_1617']); ?>; 
    var p2_G60_PP_1516 = <?php echo json_encode($echo2['G60_PP_1516']); ?>; 

    //pull primary assists
    var p1_A160_EV_1617 = <?php echo json_encode($echo1['A160_EV_1617']); ?>; 
    var p1_A160_EV_1516 = <?php echo json_encode($echo1['A160_EV_1516']); ?>; 
    var p1_A160_PP_1617 = <?php echo json_encode($echo1['A160_PP_1617']); ?>; 
    var p1_A160_PP_1516 = <?php echo json_encode($echo1['A160_PP_1516']); ?>; 

    var p2_A160_EV_1617 = <?php echo json_encode($echo2['A160_EV_1617']); ?>; 
    var p2_A160_EV_1516 = <?php echo json_encode($echo2['A160_EV_1516']); ?>; 
    var p2_A160_PP_1617 = <?php echo json_encode($echo2['A160_PP_1617']); ?>; 
    var p2_A160_PP_1516 = <?php echo json_encode($echo2['A160_PP_1516']); ?>; 
    //pull secondary assists
    var p1_A260_EV_1617 = <?php echo json_encode($echo1['A260_EV_1617']); ?>; 
    var p1_A260_EV_1516 = <?php echo json_encode($echo1['A260_EV_1516']); ?>; 
    var p1_A260_PP_1617 = <?php echo json_encode($echo1['A260_PP_1617']); ?>; 
    var p1_A260_PP_1516 = <?php echo json_encode($echo1['A260_PP_1516']); ?>; 

    var p2_A260_EV_1617 = <?php echo json_encode($echo2['A260_EV_1617']); ?>; 
    var p2_A260_EV_1516 = <?php echo json_encode($echo2['A260_EV_1516']); ?>; 
    var p2_A260_PP_1617 = <?php echo json_encode($echo2['A260_PP_1617']); ?>; 
    var p2_A260_PP_1516 = <?php echo json_encode($echo2['A260_PP_1516']); ?>; 

    //pull expected goals for
    var p1_xGF60_EV_1617 = <?php echo json_encode($echo1['xGF60_EV_1617']); ?>; 
    var p1_xGF60_EV_1516 = <?php echo json_encode($echo1['xGF60_EV_1516']); ?>; 
    var p2_xGF60_EV_1617 = <?php echo json_encode($echo2['xGF60_EV_1617']); ?>; 
    var p2_xGF60_EV_1516 = <?php echo json_encode($echo2['xGF60_EV_1516']); ?>; 
    //pull expected goals against
    var p1_xGA60_EV_1617 = <?php echo json_encode($echo1['xGA60_EV_1617']); ?>; 
    var p1_xGA60_EV_1516 = <?php echo json_encode($echo1['xGA60_EV_1516']); ?>; 
    var p2_xGA60_EV_1617 = <?php echo json_encode($echo2['xGA60_EV_1617']); ?>; 
    var p2_xGA60_EV_1516 = <?php echo json_encode($echo2['xGA60_EV_1516']); ?>; 
    //pull expected goals for team without
    var p1_xGF60_TmWO_EV_1617 = <?php echo json_encode($echo1['xGF60_TmWO_EV_1617']); ?>; 
    var p1_xGF60_TmWO_EV_1516 = <?php echo json_encode($echo1['xGF60_TmWO_EV_1516']); ?>; 
    var p2_xGF60_TmWO_EV_1617 = <?php echo json_encode($echo2['xGF60_TmWO_EV_1617']); ?>; 
    var p2_xGF60_TmWO_EV_1516 = <?php echo json_encode($echo2['xGF60_TmWO_EV_1516']); ?>; 
    //pull expected goals for team without
    var p1_xGA60_TmWO_EV_1617 = <?php echo json_encode($echo1['xGA60_TmWO_EV_1617']); ?>; 
    var p1_xGA60_TmWO_EV_1516 = <?php echo json_encode($echo1['xGA60_TmWO_EV_1516']); ?>; 
    var p2_xGA60_TmWO_EV_1617 = <?php echo json_encode($echo2['xGA60_TmWO_EV_1617']); ?>; 
    var p2_xGA60_TmWO_EV_1516 = <?php echo json_encode($echo2['xGA60_TmWO_EV_1516']); ?>; 

    //ice time by team
    var p1_ShareIce_EV_1617 = <?php echo json_encode($echo1['ShareIce_EV_1617']); ?>; 
    var p1_ShareIce_EV_1516 = <?php echo json_encode($echo1['ShareIce_EV_1516']); ?>; 
    var p2_ShareIce_EV_1617 = <?php echo json_encode($echo2['ShareIce_EV_1617']); ?>; 
    var p2_ShareIce_EV_1516 = <?php echo json_encode($echo2['ShareIce_EV_1516']); ?>; 
    //ice time by team
    var p1_ShareIce_PP_1617 = <?php echo json_encode($echo1['ShareIce_PP_1617']); ?>; 
    var p1_ShareIce_PP_1516 = <?php echo json_encode($echo1['ShareIce_PP_1516']); ?>; 
    var p2_ShareIce_PP_1617 = <?php echo json_encode($echo2['ShareIce_PP_1617']); ?>; 
    var p2_ShareIce_PP_1516 = <?php echo json_encode($echo2['ShareIce_PP_1516']); ?>; 
    //ice time by team
    var p1_ShareIce_SH_1617 = <?php echo json_encode($echo1['ShareIce_SH_1617']); ?>; 
    var p1_ShareIce_SH_1516 = <?php echo json_encode($echo1['ShareIce_SH_1516']); ?>; 
    var p2_ShareIce_SH_1617 = <?php echo json_encode($echo2['ShareIce_SH_1617']); ?>; 
    var p2_ShareIce_SH_1516 = <?php echo json_encode($echo2['ShareIce_SH_1516']); ?>; 

    //even strength usage
    var p1_OTFShift_1617 = <?php echo json_encode($echo1['OTFShift_1617']); ?>; 
    var p1_OTFShift_1516 = <?php echo json_encode($echo1['OTFShift_1516']); ?>; 
    var p2_OTFShift_1617 = <?php echo json_encode($echo2['OTFShift_1617']); ?>; 
    var p2_OTFShift_1516 = <?php echo json_encode($echo2['OTFShift_1516']); ?>; 
    //even strength usage
    var p1_FOOffShift_1617 = <?php echo json_encode($echo1['FOOffShift_1617']); ?>; 
    var p1_FOOffShift_1516 = <?php echo json_encode($echo1['FOOffShift_1516']); ?>; 
    var p2_FOOffShift_1617 = <?php echo json_encode($echo2['FOOffShift_1617']); ?>; 
    var p2_FOOffShift_1516 = <?php echo json_encode($echo2['FOOffShift_1516']); ?>; 
    //even strength usage
    var p1_FODefShift_1617 = <?php echo json_encode($echo1['FODefShift_1617']); ?>; 
    var p1_FODefShift_1516 = <?php echo json_encode($echo1['FODefShift_1516']); ?>; 
    var p2_FODefShift_1617 = <?php echo json_encode($echo2['FODefShift_1617']); ?>; 
    var p2_FODefShift_1516 = <?php echo json_encode($echo2['FODefShift_1516']); ?>; 
    //even strength usage
    var p1_FONeuShift_1617 = <?php echo json_encode($echo1['FONeuShift_1617']); ?>; 
    var p1_FONeuShift_1516 = <?php echo json_encode($echo1['FONeuShift_1516']); ?>; 
    var p2_FONeuShift_1617 = <?php echo json_encode($echo2['FONeuShift_1617']); ?>; 
    var p2_FONeuShift_1516 = <?php echo json_encode($echo2['FONeuShift_1516']); ?>; 

    //GOALIES
    //xG Lift
    var p1_xGLift_1617 = <?php echo json_encode($echo1['xGLift_1617']); ?>; 
    var p1_xGLift_1516 = <?php echo json_encode($echo1['xGLift_1516']); ?>; 
    var p2_xGLift_1617 = <?php echo json_encode($echo2['xGLift_1617']); ?>; 
    var p2_xGLift_1516 = <?php echo json_encode($echo2['xGLift_1516']); ?>; 
    //surplus points
    var p1_SurplusPts_1617 = <?php echo json_encode($echo1['SurplusPts_1617']); ?>; 
    var p1_SurplusPts_1516 = <?php echo json_encode($echo1['SurplusPts_1516']); ?>; 
    var p2_SurplusPts_1617 = <?php echo json_encode($echo2['SurplusPts_1617']); ?>; 
    var p2_SurplusPts_1516 = <?php echo json_encode($echo2['SurplusPts_1516']); ?>; 

	//PLAYER 1 PRODUCTION

	var p1_G60 = {
		  x: ['EV 201516','PP 201516','EV 201617','PP 201617'],
		  y: [p1_G60_EV_1516, p1_G60_PP_1516, p1_G60_EV_1617, p1_G60_PP_1617],
		  name: 'Goals/60',
		  type: 'bar'
		};

	var p1_A160 = {
		  x: ['EV 201516','PP 201516','EV 201617','PP 201617'],
		  y: [p1_A160_EV_1516, p1_A160_PP_1516, p1_A160_EV_1617, p1_A160_PP_1617],
		  name: 'Primary Assists/60',
		  type: 'bar'
		};

	var p1_A260 = {
		  x: ['EV 201516','PP 201516','EV 201617','PP 201617'],
		  y: [p1_A260_EV_1516, p1_A260_PP_1516, p1_A260_EV_1617, p1_A260_PP_1617],
		  name: 'Secondary Assists/60',
		  type: 'bar'
		};

	var p1_prod = [p1_G60, p1_A160, p1_A260]; 

	var layout = {
			title: player_name1 + ' Offensive Production',
			  yaxis: {
		    title: 'Scoring/60 minutes',
		    	    },
		
		barmode:'stack'}; //STACK

	Plotly.newPlot('p1_prod', p1_prod, layout);



	//PLAYER 2 PRODUCTION

	var p2_G60 = {
		  x: ['EV 201516','PP 201516','EV 201617','PP 201617'],
		  y: [p2_G60_EV_1516, p2_G60_PP_1516, p2_G60_EV_1617, p2_G60_PP_1617],
		  name: 'Goals/60',
		  type: 'bar'
		};

	var p2_A160 = {
		  x: ['EV 201516','PP 201516','EV 201617','PP 201617'],
		  y: [p2_A160_EV_1516, p2_A160_PP_1516, p2_A160_EV_1617, p2_A160_PP_1617],
		  name: 'Primary Assists/60',
		  type: 'bar'
		};

	var p2_A260 = {
		  x: ['EV 201516','PP 201516','EV 201617','PP 201617'],
		  y: [p2_A260_EV_1516, p2_A260_PP_1516, p2_A260_EV_1617, p2_A260_PP_1617],
		  name: 'Secondary Assists/60',
		  type: 'bar'
		};


	var p2_prod = [p2_G60, p2_A160, p2_A260]; 

	var layout = {
			title: player_name2 + ' Offensive Production',
			  yaxis: {
		    title: 'Scoring/60 minutes',
		    	    },
		
		barmode:'stack'}; //STACK

	Plotly.newPlot('p2_prod', p2_prod, layout);







	//PLAYER 1 XG IMPACTS

	var p1_xG_On = {
		  x: [p1_xGA60_EV_1516,p1_xGA60_EV_1617],
		  y: [p1_xGF60_EV_1516,p1_xGF60_EV_1617],
		  mode: 'markers',
		  name: 'Player On',
		  text: ['Player On 201516','Player On 201617'],
  		  marker: { size: [10,15]  },
		  type: 'scatter'
		};

	var p1_xG_Off = {
		  x: [p1_xGA60_TmWO_EV_1516, p1_xGA60_TmWO_EV_1617],
		  y: [p1_xGF60_TmWO_EV_1516, p1_xGF60_TmWO_EV_1617],
		  mode: 'markers',
		  name: 'Player Off',
 		  text: ['Player Off 201516','Player Off 201617'],
  		  marker: { size: [6,9] },
		  type: 'scatter'
		};

	var p1_xG_impact16 = {
		  x: [p1_xGA60_TmWO_EV_1516, p1_xGA60_EV_1516],
		  y: [p1_xGF60_TmWO_EV_1516, p1_xGF60_EV_1516],
		  mode: 'lines+markers',
		  text: ['Player Off 201516','Player On 201516'],
		  name: 'xG Impact 201516',
  		  marker: { size: [10,20] },
		  type: 'scatter'
		};

	var p1_xG_impact17 = {
		  x: [p1_xGA60_TmWO_EV_1617, p1_xGA60_EV_1617],
		  y: [p1_xGF60_TmWO_EV_1617, p1_xGF60_EV_1617],
		  mode: 'lines+markers',
		  text: ['Player Off 201617','Player On 201617'],
		  name: 'xG Impact 201617',
  		  marker: { size: [15,30] },
		  type: 'scatter'
		};

	var p1_xG_EV = [p1_xG_impact17,p1_xG_impact16, p1_xG_On, p1_xG_Off]; 

	var layout = {
			title: player_name1 + ' EV xG Impact',
			  yaxis: {title: 'Team Expected Goals For / 60 mins',
		 },
			  xaxis: {title: 'Team Expected Goals Against / 60 mins',
		 }
		 }; 

	Plotly.newPlot('p1_xG_EV', p1_xG_EV, layout);

	//PLAYER 2 XG IMPACTS

	var p2_xG_On = {
		  x: [p2_xGA60_EV_1516,p2_xGA60_EV_1617],
		  y: [p2_xGF60_EV_1516,p2_xGF60_EV_1617],
		  mode: 'markers',
		  name: 'Player On',
		  text: ['Player On 201516','Player On 201617'],
  		  marker: { size: [10,15]  },
		  type: 'scatter'
		};

	var p2_xG_Off = {
		  x: [p2_xGA60_TmWO_EV_1516, p2_xGA60_TmWO_EV_1617],
		  y: [p2_xGF60_TmWO_EV_1516, p2_xGF60_TmWO_EV_1617],
		  mode: 'markers',
		  name: 'Player Off',
 		  text: ['Player Off 201516','Player Off 201617'],
  		  marker: { size: [6,9] },
		  type: 'scatter'
		};

	var p2_xG_impact16 = {
		  x: [p2_xGA60_TmWO_EV_1516, p2_xGA60_EV_1516],
		  y: [p2_xGF60_TmWO_EV_1516, p2_xGF60_EV_1516],
		  mode: 'lines+markers',
		  text: ['Player Off 201516','Player On 201516'],
		  name: 'xG Impact 201516',
  		  marker: { size: [10,20] },
		  type: 'scatter'
		};

	var p2_xG_impact17 = {
		  x: [p2_xGA60_TmWO_EV_1617, p2_xGA60_EV_1617],
		  y: [p2_xGF60_TmWO_EV_1617, p2_xGF60_EV_1617],
		  mode: 'lines+markers',
		  text: ['Player Off 201617','Player On 201617'],
		  name: 'xG Impact 201617',
  		  marker: { size: [15,30] },
		  type: 'scatter'
		};

	var p2_xG_EV = [p2_xG_impact17,p2_xG_impact16, p2_xG_On, p2_xG_Off]; 

	var layout = {
			title: player_name2 + ' EV xG Impact',
			  yaxis: {title: 'Team Expected Goals For / 60 mins',
		 },
			  xaxis: {title: 'Team Expected Goals Against / 60 mins',
		 }
		 }; 

	Plotly.newPlot('p2_xG_EV', p2_xG_EV, layout);


	//Ice Time
	var ShareIce_EV_17 = {
		  x: [player_name1, player_name2],
		  y: [p1_ShareIce_EV_1617, p2_ShareIce_EV_1617],
		  name: 'Even Strength',
		  type: 'bar'
		};

	var ShareIce_EV_16 = {
		  x: [player_name1, player_name2],
		  y: [p1_ShareIce_EV_1516, p2_ShareIce_EV_1516],
		  name: 'Even Strength',
		  type: 'bar'
		};

	var ShareIce_PP_17 = {
		  x: [player_name1, player_name2],
		  y: [p1_ShareIce_PP_1617, p2_ShareIce_PP_1617],
		  name: 'Powerplay',
		  type: 'bar'
		};

	var ShareIce_PP_16 = {
		  x: [player_name1, player_name2],
		  y: [p1_ShareIce_PP_1516, p2_ShareIce_PP_1516],
		  name: 'Powerplay',
		  type: 'bar'
		};

	var ShareIce_SH_17 = {
		  x: [player_name1, player_name2],
		  y: [p1_ShareIce_SH_1617, p2_ShareIce_SH_1617],
		  name: 'Shorthanded',
		  type: 'bar'
		};

	var ShareIce_SH_16 = {
		  x: [player_name1, player_name2],
		  y: [p1_ShareIce_SH_1516, p2_ShareIce_SH_1516],
		  name: 'Shorthanded',
		  type: 'bar'
		};

	//2016-17
	var strength17 = [ShareIce_EV_17, ShareIce_PP_17, ShareIce_SH_17]; 

	var layout = {
			title: 'Player Share of Team Icetime, 2016-17',
			  yaxis: {
		    title: '',
		    	    },
		
		barmode:'group'}; //STACK

	Plotly.newPlot('strength17', strength17, layout);

	//2015-16
	var strength16 = [ShareIce_EV_16, ShareIce_PP_16, ShareIce_SH_16]; 

	var layout = {
			title: 'Player Share of Team Icetime, 2015-16',
			  yaxis: {
		    title: '',
		    	    },
		
		barmode:'group'}; //STACK

	Plotly.newPlot('strength16', strength16, layout);


	///Player Usages
	var PlayerUsage_OTF_17 = {
		  x: [player_name1, player_name2],
		  y: [p1_OTFShift_1617, p2_OTFShift_1617],
		  name: 'On The Fly',
		  type: 'bar'
		};

	var PlayerUsage_OTF_16 = {
		  x: [player_name1, player_name2],
		  y: [p1_OTFShift_1617, p2_OTFShift_1617],
		  name: 'On The Fly',
		  type: 'bar'
		};

	var PlayerUsage_Off_17 = {
		  x: [player_name1, player_name2],
		  y: [p1_FOOffShift_1617, p2_FOOffShift_1617],
		  name: 'Offensive Zone Faceoff',
		  type: 'bar'
		};

	var PlayerUsage_Off_16 = {
		  x: [player_name1, player_name2],
		  y: [p1_FOOffShift_1516, p2_FOOffShift_1516],
		  name: 'Offensive Zone Faceoff',
		  type: 'bar'
		};

	var PlayerUsage_Def_17 = {
		  x: [player_name1, player_name2],
		  y: [p1_FODefShift_1617, p2_FODefShift_1617],
		  name: 'Defensive Zone Faceoff',
		  type: 'bar'
		};

	var PlayerUsage_Def_16 = {
		  x: [player_name1, player_name2],
		  y: [p1_FODefShift_1516, p2_FODefShift_1516],
		  name: 'Defensive Zone Faceoff',
		  type: 'bar'
		};

	var PlayerUsage_Neu_17 = {
		  x: [player_name1, player_name2],
		  y: [p1_FONeuShift_1617, p2_FONeuShift_1617],
		  name: 'Neutral Zone Faceoff',
		  type: 'bar'
		};

	var PlayerUsage_Neu_16 = {
		  x: [player_name1, player_name2],
		  y: [p1_FONeuShift_1516, p2_FONeuShift_1516],
		  name: 'Neutral Zone Faceoff',
		  type: 'bar'
		};

	//2016-17
	var usage17 = [PlayerUsage_OTF_17, PlayerUsage_Off_17, PlayerUsage_Def_17, PlayerUsage_Neu_17]; 

	var layout = {
			title: 'Player Even Strength Shift Starts, 2016-17',
			  yaxis: {
		    title: '',
		    	    },
		
		barmode:'stack'}; //STACK

	Plotly.newPlot('usage17', usage17, layout);

	//2015-16
	var usage16 = [PlayerUsage_OTF_16, PlayerUsage_Off_16, PlayerUsage_Def_16, PlayerUsage_Neu_16]; 

	var layout = {
			title: 'Player Even Strength Shift Starts, 2015-16',
			  yaxis: {
		    title: '',
		    	    },
		
		barmode:'stack'}; //STACK

	Plotly.newPlot('usage16', usage16, layout);


  </script>
