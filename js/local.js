
var sudokuArray = new Array(81);
var jSudokuArray=new Array(81);
// var emptySudoku=new Array(81);
var seconds=0;
var minutes=0;
var hours=0;
var t;

function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    
    $(".stopwatch").html((hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds));

    timer();
}
function timer() {
    t = setTimeout(add, 1000);
}


function zeroSudoku(){
	for (var i =0; i<81;i++ ){
		sudokuArray[i]=0;
	}
}

function inRow(number, row,column){
	var num=0;
	for (var j =0; j<=column;j++ ){
		if(sudokuArray[row*9+j]==number){
			num++;
			if(num>1){
				return false;
			}
		}
	}
	return true;
}

function inColumn(number,row, column){
	var num=0;
	for (var i =0; i<=row;i++ ){
		if(sudokuArray[i*9+column]==number){
			num++;
			if(num>1){
				return false;
			}
		}
	}
	return true;
}

function inSquare(number, row, column){
	var num=0;
	if(row<3){
		if(column<3){
			for (var i = 0; i <3; i++) {
				for (var j = 0; j < 3; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}
		if(column<6){
			for (var i = 0; i <3; i++) {
				for (var j = 3; j < 6; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}
		if(column<9){
			for (var i = 0; i <3; i++) {
				for (var j = 6; j < 9; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}

	}
	if(row<6){
		if(column<3){
			for (var i = 3; i <6; i++) {
				for (var j = 0; j < 3; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}
		if(column<6){
			for (var i = 3; i <6; i++) {
				for (var j = 3; j < 6; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}
		if(column<9){
			for (var i = 3; i <6; i++) {
				for (var j = 6; j < 9; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}

	}
	if(row<9){
		if(column<3){
			for (var i = 6; i <9; i++) {
				for (var j = 0; j < 3; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}
		if(column<6){
			for (var i = 6; i <9; i++) {
				for (var j = 3; j < 6; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}
		if(column<9){
			for (var i = 6; i <9; i++) {
				for (var j = 6; j < 9; j++) {
					if(sudokuArray[i*9+j]==number){
						num++;
						if(num>1){
							return false;
						}
					}
		 		}
			}
			return true;
		}

	}
	return true;
}

function generateSudoku(){
	var br=0;
	for (var i = 0; i < 9; i++) {
		for (var j = 0; j<9; j++) {
			var k=0;
			while(k <25){
				var x= Math.floor(Math.random() * 9) + 1;
				sudokuArray[i*9+j]=x;
				if((inRow(x, i,j)==true) && (inColumn(x,i,j)==true) && (inSquare(x,i,j)==true)){
					
					break;
				}else{
				k+=1;
				}	
			}
			if(k==25){
				i=-1;
				zeroSudoku();
				break;
			}
		}
	}
}

function generateEmptyFields(){
	for (var i =0; i < 9; i++) {
		var emptyNum=Math.floor(Math.random() * 2) +8 ;
		for (var j = 0; j < emptyNum; j++) {
			var gen=Math.floor(Math.random() * 9);
			var columnIndex=0;
			if(gen!=columnIndex){
				columnIndex=gen;
			}
		 	sudokuArray[i*9+columnIndex]="";
		}
	}

}

function printSudoku(){
	for (var i = 0; i <9; i++) {
		for (var j = 0; j < 9; j++) {
			var sel2="tr."+i+" td."+j;
			var sel="tr."+i+" td."+j+" input";
		 	$(sel).val(sudokuArray[i*9+j]);
		 	if(sudokuArray[i*9+j]==""){
		 		$(sel).attr("readonly", false).css({"background-color": '#edf1f7'});
		 		$(sel2).css({"background-color": '#edf1f7'});
		 	}
		 	else{$(sel).attr("readonly", true).css({"background-color": '#dbe7fc'});
		 			$(sel2).css({"background-color": '#dbe7fc'});}
		}
	}

}

function checkSudoku(){
	for (var i = 0; i <9; i++) {
		for (var j = 0; j < 9; j++) {
			var sel="tr."+i+" td."+j+" input";
		 	var x=$(sel).val();
		 	jSudokuArray[i*9+j]=x;
		}
	}

	for (var i = 0; i <9; i++) {
		for (var j = 0; j < 9; j++) {
		 	var x=jSudokuArray[i*9+j];
		 	//console.log(x);
		 	if($.isNumeric(x)){
			 	if((inRow(x,i,j)==false) || (inColumn(x,i,j)==false) || (inSquare(x,i,j)==false ) || x<1){
			 			console.log(i +" "+j);	
			 			return false;		 		
			 	}
			}
			else{
				
				return false;
			}
		}
	}
	return true;

}
function restartStopwatch(){
	clearTimeout(t);
	hours=0;
	minutes=0;
	seconds=-1;
	timer();

}

// click on check
$("#check").click(function(){
	clearTimeout(t);
	$(".table").hide();
	if(checkSudoku()==true){
		console.log("uspesno");
		$(".check.p").show();

	}
	else{
		console.log("neuspesno");
		$(".check.f").show();
	}
	
});

// click on start 
$(".start").click(function(){
	timer();
	$(".on.open").hide();
	$(".table").css('display', 'flex');
	for (var i = 0; i < 9; i++) {

		$("#sudoku").append($("<tr>").attr("class",i));
	}
	for (var i = 0; i <9; i++) {
		var sel="tr."+i;
		for (var j = 0; j < 9; j++) {
		 	$(sel).append($("<td>").attr("class",j));
		 	var sel2="tr."+i+" td."+j;
		 	$(sel2).append("<input oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'type='number' min='1' max='9' maxLength='1'></input>");
		}
	}
	generateSudoku();
	generateEmptyFields();
	printSudoku();
	
	
});
// click on newgame 
$(".newgame").click(function(){
	restartStopwatch();
	$(".table").show();
	$(".check.p").hide();
	$(".check.f").hide();
	generateSudoku();
	generateEmptyFields();
	printSudoku();
	
});
// click on pause
$(".pause").click(function(){
	clearTimeout(t);
	$(".table").hide();
	$(".paus").show();

});
// click on continue
$(".continue").click(function(){
	timer();
	$(".check.p").hide();
	$(".check.f").hide();
	$(".paus").hide();
	$(".table").show();
});
// hover and unhover pause
$(".on-pause a").hover(
	function(){
	  	$(".on.paus a img").attr('src','img/play-hover.png')},
	function(){
  		$(".on.paus a img").attr('src','img/play.png')
});
// clock on restart
$(".restart").click(function(){
	restartStopwatch();
	$(".table").show();
	$(".check.p").hide();
	$(".check.f").hide();
	printSudoku();
});