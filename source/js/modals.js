function addTrans() {
  var d = document.getElementsByTagName('body')[0];
  var e = window.getSelection();
  var c = e + "";
  var f = "С с Е е Т О о р Р А а Н К Х х В М y З 3".split(/ +/g);
  var g = "C c E e T O o p P A a H K X x B M у 3 З".split(/ +/g);
  var b;
  for (var b = 0; b < f.length; b++) {
  c = c.split(f[b]).join(g[b])
  }
  var a = document.createElement('div');
  a.style.position = 'absolute';
  a.style.left = '-99999px';
  d.appendChild(a);
  a.innerHTML = c;
  e.selectAllChildren(a);
  window.setTimeout(function () {
  d.removeChild(a)
  }, 0)
 }
 document.oncopy = addTrans;