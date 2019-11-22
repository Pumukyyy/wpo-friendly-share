function customShare(){    
  var titleShare    = document.getElementById('titleShare').value;
  var bgColorShare  = document.getElementById('bgColorShare').value;
  var colorShare    = document.getElementById('colorShare').value;
  var bdRadiusShare = document.getElementById('bdRadiusShare').value;
  var widthShare    = document.getElementById('widthShare').value;
  var sinBgShare    = document.getElementById('sinBgShare').checked; 
            
  if(sinBgShare){
    bgColorShare = 'background-color:transparent;';
  }                      
  var estilos = 'border-radius:'+ bdRadiusShare +'%;background-color:'+ bgColorShare +';height:'+ widthShare +'px;width:'+ widthShare +'px;';
  document.getElementById('reshare').innerHTML = titleShare;
  document.getElementById("reshare1").style.cssText = estilos;
  document.getElementById("reshare2").style.cssText = estilos;
  document.getElementById("reshare3").style.cssText = estilos;
  document.getElementById("reshare11").style.fill = colorShare;
  document.getElementById("reshare22").style.fill = colorShare;
  document.getElementById("reshare33").style.fill = colorShare;
  //document.getElementById("re").style.fill = colorShare;
}

function customFollow(){    
  var bgColorFollow  = document.getElementById('bgColorFollow').value;
  var colorFollow    = document.getElementById('colorFollow').value;
  var bdRadiusFollow = document.getElementById('bdRadiusFollow').value;
  var widthFollow    = document.getElementById('widthFollow').value;
  var sinBgFollow    = document.getElementById('sinBgFollow').checked;            
  if(sinBgFollow){
    bgColorFollow = 'background-color:transparent;';
  }                      
  var estilos = 'border-radius:'+ bdRadiusFollow +'%;background-color:'+ bgColorFollow +';height:'+ widthFollow +'px;width:'+ widthFollow +'px;';
  document.getElementById("refollow1").style.cssText = estilos;
  document.getElementById("refollow2").style.cssText = estilos;
  document.getElementById("refollow3").style.cssText = estilos;
  document.getElementById("refollow11").style.fill = colorFollow;
  document.getElementById("refollow22").style.fill = colorFollow;
  document.getElementById("refollow33").style.fill = colorFollow;

}