
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
  document.getElementById('reshare').innerHTML = titleShare;
  document.getElementById('reshare').style.cssText = tituloStyle;

  var y, x, g, i;
  y =  document.querySelectorAll(".select_share");
  x = document.querySelectorAll(".result-share");
  g = document.querySelectorAll(".result-share .social-icon");
  for (i = 0; i < x.length; i++) {
    if( y[i].checked == false ){
      x[i].style.cssText = iconoStyle + "display:none"
    }else{
      x[i].style.cssText = iconoStyle + "display:inline-block";
    }
    g[i].style.fill = colorShare;
  }
}

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
  document.getElementById('refollow').innerHTML = titleFollow;
  document.getElementById('refollow').style.cssText = tituloStyle;

  var y, x, g, i;
  y =  document.querySelectorAll(".select_follow");
  x = document.querySelectorAll(".result-follow");
  g = document.querySelectorAll(".result-follow .social-icon");
  for (i = 0; i < x.length; i++) {
    if( y[i].checked == false ){
      x[i].style.cssText = iconoStyle + "display:none"
    }else{
      x[i].style.cssText = iconoStyle + "display:inline-block";
    }
    g[i].style.fill = colorShare;
  }

}
