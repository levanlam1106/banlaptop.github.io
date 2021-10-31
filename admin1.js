var themSanPham = document.getElementsByClassName("themSanPham")[0];
var addSanPham = document.getElementsByClassName("addSanPham")[0];
var close = document.getElementsByClassName("close")[0];
var frm_hienthi = document.getElementById("frm_hienthi"); 
themSanPham.onclick = function(){
  addSanPham.style.display = "block";
  frm_hienthi.style.display = "none";
}
close.onclick = function(){
  addSanPham.style.display = "none";
  frm_hienthi.style.display = "block";
}