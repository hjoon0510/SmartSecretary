function player(){
 var pointer, playlists, subjectlists;
 var obj_player, obj_source;
 var displayLine;
}
player.prototype.create = function(){
 var obj = this;
 var players, source = null;
 var displayLine = null;
 
 try{
  players = document.createElement("audio");
  source = document.createElement("source");
  displayLine = document.createElement("p");
  btnPlay = document.createElement("button");
  btnStop = document.createElement("button");
  btnPause = document.createElement("button");
  btnPrev = document.createElement("button");
  btnNext = document.createElement("button");
  btnFoward = document.createElement("button");
  btnBackward = document.createElement("button");

  players.preload="preload";
  displayLine.style.cssText="display:block; width:98%; padding:1%; background:#CCC; color:#444";
  displayLine.innerHTML = "Initializing...";
  btnPlay.innerText = "재생";
  btnStop.innerText = "정지";
  btnPause.innerText = "일시정지";
  btnPrev.innerText = "이전트랙";
  btnNext.innerText = "다음트랙";
  btnFoward.innerText = "5초 앞으로";
  btnBackward.innerText = "5초 뒤로";

  if(window.event != null){
   btnPlay.attachEvent("onclick", function(){obj.play();});
   btnStop.attachEvent("onclick", function(){obj.stop();});
   btnPause.attachEvent("onclick", function(){obj.pause();});
   btnPrev.attachEvent("onclick", function(){obj.prev();});
   btnNext.attachEvent("onclick", function(){obj.next();});
   btnFoward.attachEvent("onclick", function(){obj.foward();});
   btnBackward.attachEvent("onclick", function(){obj.backward();});
   players.attachEvent("ontimeupdate",function(){obj.callback();});
   players.attachEvent("onended",function(){obj.next();});
  } else {
   btnPlay.addEventListener("click", function(){obj.play();},false);
   btnStop.addEventListener("click", function(){obj.stop();},false);
   btnPause.addEventListener("click", function(){obj.pause();},false);
   btnPrev.addEventListener("click", function(){obj.prev();},false);
   btnNext.addEventListener("click", function(){obj.next();},false);
   btnFoward.addEventListener("click", function(){obj.foward();},false);
   btnBackward.addEventListener("click", function(){obj.backward();},false);
   players.addEventListener("timeupdate",function(){obj.callback();},false);
   players.addEventListener("ended",function(){obj.next();},false);
  }

  players.appendChild(source);
  document.body.appendChild(players);
  document.body.appendChild(displayLine);
  document.body.appendChild(btnPrev);
  document.body.appendChild(btnBackward);
  document.body.appendChild(btnPause);
  document.body.appendChild(btnPlay);
  document.body.appendChild(btnStop);
  document.body.appendChild(btnFoward);
  document.body.appendChild(btnNext);

  obj.pointer = 0;
  obj.obj_player = players;
  obj.obj_source = source;
  obj.displayLine = displayLine;

  obj.playlists = new Array();
  obj.subjectlists = new Array();
  obj.playlists.push("exam");
  obj.playlists.push("exam2");
  obj.subjectlists.push("Windows Welcome Music - Microsoft");
  obj.subjectlists.push("Welcome Windows98 Start");

  obj.displayLine.innerHTML = "Load Complete!";
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.create");
 }
}
player.prototype.checkFileType = function(){
 var obj = this;
 try{
  var str = arguments[0].substring(arguments[0]-3,arguments[0]);
  var typeRef = {
    'mp3' : "audio/mpeg",
    'ogg' : "audio/ogg"
  }
  if(typeRef[str]!=""){
   return typeRef[str];
  } else {
   return -1;
  }
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.checkFIleType");
 }
}
player.prototype.play = function(){
 var obj = this;
 try{
  if(obj.obj_player.currentTime==0){
  obj.obj_source.type = obj.checkFileType(obj.playlists[obj.pointer]);
  if(obj.obj_player.canPlayType("audio/mpeg")!=""){
    obj.obj_source.type = "audio/mpeg";
    obj.obj_source.src = obj.playlists[obj.pointer] + ".mp3";
    obj.obj_player.src = obj.playlists[obj.pointer] + ".mp3";
  } else {
    obj.obj_source.type = "audio/ogg";
    obj.obj_source.src = obj.playlists[obj.pointer] + ".ogg";
    obj.obj_player.src = obj.playlists[obj.pointer] + ".ogg";
  }
  obj.obj_player.load();
  }
  obj.obj_player.play();
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.play");
 }
}

player.prototype.stop = function(){
 var obj = this;
 try{
  obj.displayLine.innerHTML = "[Stopped]";
  obj.obj_player.pause();
  obj.obj_player.currentTime = 0;
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.create");
 }
}
player.prototype.pause = function(){
 var obj = this;
 try{
  obj.displayLine.innerHTML = "[Paused]";
  obj.obj_player.pause();
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.create");
 }
}
player.prototype.prev = function(){
 var obj = this;
 try{
  obj.stop();
  obj.pointer--;
  if(obj.pointer<0){
    obj.pointer = obj.playlists.length-1;
  }
  obj.play();
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.create");
 }
}
player.prototype.next = function(){
 var obj = this;
 try{
  obj.stop();
  obj.pointer++;
  if(obj.pointer>obj.playlists.length-1){
    obj.pointer = 0;
  }
  obj.play();
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.create");
 }
}
player.prototype.backward = function(){
 var obj = this;
 try{
  obj.obj_player.currentTime -= 5;
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.create");
 }
}
player.prototype.foward = function(){
 var obj = this;
 try{
  obj.obj_player.currentTime += 5;
 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.create");
 }
}
player.prototype.callback = function(){
 var obj = this;
 var totalTime, total_min, total_sec;
 var currentTime, run_min, run_sec;
 try{
  totalTime = obj.obj_player.duration;
  currentTime = obj.obj_player.currentTime;
  total_min = Math.floor(Math.floor(totalTime)/60);
  total_sec = Math.floor(totalTime) - total_min*60;
  totalTime = String(total_min) + ":" + String(total_sec);

  run_min = Math.floor(Math.floor(currentTime)/60);
  run_sec = Math.floor(currentTime) - run_min*60;
  currentTime = String(run_min) + ":" + String(run_sec);

  obj.displayLine.innerHTML = "지금 재생중..."+obj.subjectlists[obj.pointer];
  obj.displayLine.innerHTML += " ("+currentTime + " / " + totalTime+")";

 } catch(e) {
  alert(e+"\n "+e.description+"\n\t at player.callback");
 }
}

var player_ctrl = new player;