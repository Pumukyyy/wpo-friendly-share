//funcion que controla las opciones de customizacion 
function viewCustomShare(){    

  var titleShare         = document.getElementById('titleShare').value;
  var bgColorShare       = document.getElementById('bgColorShare').value;
  var colorShare         = document.getElementById('colorShare').value;
  var bdRadiusShare      = document.getElementById('bdRadiusShare').value;
  var widthShare         = document.getElementById('widthShare').value;
  var sinBgShare         = document.getElementById('sinBgShare').checked;
  var colorTitleShare    = document.getElementById('colorTitleShare').value;
  var titleSizeShare     = document.getElementById('titleSizeShare').value;
            
  if(sinBgShare){
    bgColorShare = 'background:transparent;';
  }

  var tituloStyle  = 'color:'+ colorTitleShare +';font-size:'+ titleSizeShare + 'px;';                
  var iconoStyle = 'border-radius:'+ bdRadiusShare +'%;background-color:'+ bgColorShare +';height:'+ widthShare +'px;width:'+ widthShare +'px;';
  document.getElementById('result-title-share').innerHTML = titleShare;
  document.getElementById('result-title-share').style.cssText = tituloStyle;

  var y, x, g, i;
  y =  document.querySelectorAll(".select-share");
  x = document.querySelectorAll(".result-icon-share");
  g = document.querySelectorAll(".result-icon-share .social-icon");

  for (i = 0; i < x.length; i++) {

    if( y[i].checked == false ){
      x[i].style.cssText = iconoStyle + "display:none"
    }else{
      x[i].style.cssText = iconoStyle + "display:inline-block";
    }
    g[i].style.fill = colorShare;

  }

}

//funcion que controla las opciones de customizacion 
function viewCustomFollow(){

  var titleFollow         = document.getElementById('titleFollow').value;   
  var bgColorFollow       = document.getElementById('bgColorFollow').value;
  var colorFollow         = document.getElementById('colorFollow').value;
  var bdRadiusFollow      = document.getElementById('bdRadiusFollow').value;
  var widthFollow         = document.getElementById('widthFollow').value;
  var sinBgFollow         = document.getElementById('sinBgFollow').checked;
  var colorTitleFollow    = document.getElementById('colorTitleFollow').value;
  var titleSizeFollow     = document.getElementById('titleSizeFollow').value;            
  if(sinBgFollow){
    bgColorFollow = 'background:transparent;';
  }                      
  var tituloStyle  = 'color:'+ colorTitleFollow +';font-size:'+ titleSizeFollow + 'px;';                
  var iconoStyle = 'border-radius:'+ bdRadiusFollow +'%;background-color:'+ bgColorFollow +';height:'+ widthFollow +'px;width:'+ widthFollow +'px;';
  document.getElementById('result-title-follow').innerHTML = titleFollow;
  document.getElementById('result-title-follow').style.cssText = tituloStyle;

  var y, x, g, i;
  y =  document.querySelectorAll(".select-follow");
  x = document.querySelectorAll(".result-icon-follow");
  g = document.querySelectorAll(".result-icon-follow .social-icon");

  for (i = 0; i < x.length; i++) {

    if( y[i].checked == false ){
      x[i].style.cssText = iconoStyle + "display:none"
    }else{
      x[i].style.cssText = iconoStyle + "display:inline-block";
    }
    g[i].style.fill = colorShare;

  }

}

//document.getElementById("optionsCustomShare").addEventListener("click", optionsCustomS);

//funcion para ocultar o mostrar las opciones de customizacion y cambiar el texto del boton
function optionsCustomS() {

var optionsCustomShare  = document.querySelector('#optionsCustomShare'); 
var entryCustomShare    = document.querySelector("#entryCustomShare");

 if( optionsCustomShare.checked == false ){
      entryCustomShare.classList.add("oculto");
      document.querySelector('#menos-s').classList.add("oculto");
      document.querySelector('#mas-s').classList.remove("oculto");
    }else{
      entryCustomShare.classList.remove("oculto");
      document.querySelector('#mas-s').classList.add("oculto");
      document.querySelector('#menos-s').classList.remove("oculto");
  }

}

//funcion para ocultar o mostrar las opciones de customizacion y cambiar el texto del boton
function optionsCustomF() {

  var optionsCustomFollow  = document.querySelector('#optionsCustomFollow'); 
  var entryCustomFollow    = document.querySelector("#entryCustomFollow");

   if( optionsCustomFollow.checked == false ){
        entryCustomFollow.classList.add("oculto");
        document.querySelector('#menos-f').classList.add("oculto");
        document.querySelector('#mas-f').classList.remove("oculto");
      }else{
        entryCustomFollow.classList.remove("oculto");
        document.querySelector('#mas-f').classList.add("oculto");
        document.querySelector('#menos-f').classList.remove("oculto");
    }

}
