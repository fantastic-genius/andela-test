<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<script>

<!--START: Function to remove and count duplicate character -->

function removeDuplicates(word){
  var newWord = removeSpecialChars(word);
   try{ 
     
     var newStr = newWord.toLowerCase().split("").sort().join("");
     
     var result = '';
     for(var i = 0; i < newStr.length; i++) {
        if(result.indexOf(newStr[i]) < 0) {
          result += newStr[i];
        }
     }
     
     
     
     var duplicate = repeatedCharCount(newStr);
  
     
     //var resultObj = {uniques: "'/" + result +"'/", duplicates: duplicate};
     return "{uniques: \'" + result + "\', duplicates: " + duplicate +"}";
   }
   catch(e){
     return 0; 
   }
  
}


function removeSpecialChars(str) {
   return str.replace(/(?!\w)./g, '').replace(/_/g, "");
 
}

function repeatedCharCount(str){
	var duplicate = 0;
    var word = str;
    
	for(var i = 0; i < word.length; i++){
    	var char = word.charAt(i);
        var charReg = new RegExp(char, 'gi');
        var count = word.match(charReg).length;
        
    
        if(count > 1){
        	duplicate ++;
            word = word.replace(charReg, "");
        }
    }
    return duplicate;
}

<!-- END -->


<!--START: Create a shpping class and make Shop class inherits its properties -->
function ShoppingCart(){
  this.total = 0;
  this.items = {};
}


ShoppingCart.prototype.addItem = function(item_name, quantity, price){
  this.total += quantity * price;
  this.item_name = item_name;
  this.quantity = quantity;
  this.items[item_name] = quantity ;
}

ShoppingCart.prototype.removeItem = function(item_name, quantity, price){
  
  if(quantity > 0){
    if(quantity >= this.items[item_name]){
      this.total -= this.items[item_name] * price;
      delete this.items[item_name];     
    }else{
      this.total -= quantity * price;
      this.items[item_name] -= quantity;
    }
  }
}

ShoppingCart.prototype.checkout = function(cash_paid){
  if(cash_paid < this.total){
    return "Cash paid not enough";
  }else{
    var balance = cash_paid - this.total;
    return balance;
  }
  
}

Shop.prototype = new ShoppingCart();
function Shop(){
  this.quantity = 100;
};
 

Shop.prototype.removeItem = function(){
  this.quantity -= 1;
}

<!-- END -->

<!--START: Create a function to check if a word is an Isogram -->
function isIsogram(word){
  
  try{
    var newStr = word.toLowerCase();
    var result = false;
    
    if(word === null || word === ''){
      result = false;
    }else{
      result = countDuplicate(newStr);
    }
	
    return result;
  }
  catch(e){
    return false;
  }
  
  
}

function countDuplicate(str){
  var word = str;
  var duplicate = 0;
  var result = true;
  for(var i = 0; i < word.length; i++){
    var wordChar = word.charAt(i);
    var charReg = new RegExp(wordChar, 'gi');
    var charCount = word.match(charReg).length;
    
    if(charCount > 1){
      duplicate ++;
      word = word.replace(charReg, "");
    }
  }
  if(duplicate > 0){
    result = false;
  }else if(duplicate === 0){
    result = true;
  }
  
  return result;
}

<!-- END -->

<!--START: Create a function to take power of a number -->
function power(a, b){
  var total = 1;
  if(b === 0){
    total = 1;
  }else{
    for(var i = 1; i <= b; i++){
      total *= a;
    }
  }
  return total
  
  
}

<!-- END -->


<!--START: Function to find longest word in a sentence -->
function longest(sentence){
  sentenceArray = sentence.split(" ");
  
  var longLen = 0;
  var longWord = "";
  for(var i = 0; i < sentenceArray.length; i++){
    var length = sentenceArray[i].length;
    
    if(length > longLen){
      longLen = length;
      longWord = sentenceArray[i];
    }
    
  }
  return longWord;
  
}
<!-- END -->

<!--START: Function to caculate the numberof letters used bewteen an integer and 1 -->
function sumLetterCount(n){
	var totalCount = 0;
	var i = 1;
	while(i <= n){
		sumLetterCount(n-1);
		if(n > 0){
			totalCount += calcLetter(n);
			i++;
		}
	}
	
}
function calcLetter(val){
	var numArr = val.toString().split("").reverse();
	var digitCount = numArr.length;
	var numGrp = Math.ceil(digitCount / 3);
	var totalLetterCount = 0;
	
	var grpArr = [];
	if(numGrp <= 5){
		var j = 0;
		for(i = 0; i < numGrp; i++){
			grpArr[i] = numArr.slice(j, j + 3);
			j = j + 3;
		}
		
		for(i = 0; i < grpArr.length; i++){
			for(k = 0; k < grpArr[i].length; k++){
				totalLetterCount += getDigitLetterCount(grpArr[i][k], k); 
				
			}
			if(i > 0){
				totalLetterCount += checkGroupSet(i);
			}
		}
	
		return totalLetterCount;
	}else{
		return "cannot count numbers above trillion";
	}
}


function getDigitLetterCount(digit, pos){
	var letterCount = 0;
    var digitInt = parseInt(digit);
	if(pos == 0 || pos == 2){
		switch(digitInt){
        	case 0:
              letterCount = 0;
              break;
			case 1:
			case 2:
              letterCount = 3;
              break;
			case 3:
              letterCount = 5;
              break;
			case 4:
			case 5:
              letterCount = 4;
              break;
			case 6:
              letterCount = 3;
              break;
			case 7:
			case 8:
              letterCount = 5;
              break;
			case 9:
              letterCount = 4;
              break;
		}
        if(pos == 2){
        	switch(digitInt){
              case 0:
                  letterCount += 0;
                  break;
              default:
                  letterCount += 7;
                  break;
            }
		}
		
	}else if(pos == 1){
		switch(digitInt){
        	case 0:
              letterCount = 0;
              break;
			case 1:
			letterCount = 3;
			break;
			case 2:
			case 3:
			letterCount = 6;
			break;
			case 4:
			case 5:
			case 6:
			letterCount = 5;
			break;
			case 7:
			letterCount = 7;
			break;
			case 8:
			letterCount = 6;
			break;
			case 9:
			letterCount = 5;
			break;
			default:
		}
		
	}
	
	return letterCount;
}

function checkGroupSet(pos){
	var addLetterCount = 0;
	if(pos = 1){
		//for thousand
		addLetterCount += 8;
	}else if(pos == 2 || pos == 3){
		//for million or billion
		addLetterCount += 6;
	}else if(pos == 4){
		//for trillion
		addLetterCount += 7;
	}
	
	return addLetterCount;
}

//var length = Math.log(453) * Math.LOG10E + 1 | 0;
<!-- END -->

<!--START: Function to caculate the multiple of 3 and 5 less than the given integer -->
function sumMultiple(val){
	var m = Math.floor(val / 3);
	var n = Math.floor(val / 5);
	
	total = 0;
	if(n > 0){
		for(i = 1; i <= m; i++){
			var currentVal = 3 * i;
			if(currentVal < val){
				total += currentVal;
			}
		}
	}
	
	if(m > 0){
		for (i = 1; i <= n; i++){
			var currentVal = 5 * i;
			if(currentVal < val){
				total += currentVal;
			}
		}
	}
	
	return total;
}
<!-- END -->


<!--START: Function to get the nth prime number -->

function findPrimeNum(n){
	var primeNumbers = [];
	var currentNum = 2;
	while(primeNumbers.length < n){
		if(currentNum % 2 == 0){
			if(currentNum == 2){
				primeNumbers.push(n);
			}
		}else{
			var status = false;
			
			var j = 0;
			while(j < primeNumbers.length){
				var divResult = currentNum % primeNumbers[j];
				if(divResult == 0 ){
					status = true;
					j++;
				}
				
			}
			
			if(status == true){
				primeNumbers.push(currentNum);
			}
		}
		
		currentNum++;
	}
	return primeNumbers[n - 1];
}

function findPrimeNum(nthTerm){
	var primeNumbers = [];
	testForPrime(nthTerm, primeNumbers)
}
function testForPrime(nth, primeNumArr){
	var i = 2;
	while(i > 1 && primNumArr.length <= nth){
		var currentNum = i;
		if(currentNum % 2 === 0){
			if(currentNum === 2){
				primeNumArr.push(currentNum);
			}
		}else{
			var status = false;
			for(j = 0; j < primeNumArr.length; j++ ){
				var divResult = currentNum % primeNumArr[j];
				if(divResult === 0 ){
					i++;
					testForPrime(nth, primeNumArr);
				}
			}
			i++;
			primeNumArr.push(currentNum);
		}
	}
}
<!-- END -->

<!--START: Function to get Fibonacci nth term -->
function fibonacci(n){
	numArr = [];
	var i = 0;
	var total = 0;
	while(i < n){
		fibonacci(n-1);
		if(n == 1){
			numArr.push(1);
		}else if(n == 2){
			numArr.push(2);
		}else{
			numArr.push(numArr[n-2] + numArr[n-3]);
		}
		if(numArr[i] % 2 == 0){
			total += numArr[i];
		}
		i++;
		
	}
	return numArr[n-1];
}


<!-- END -->



</script>
</body>
</html>