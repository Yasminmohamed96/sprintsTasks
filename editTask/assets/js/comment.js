"use strict";

let apiUrll = "comments";
debugger;
let likeComment = async (id) => {
  document
    .querySelector(`#likeComment_btn_${id}`)
    .setAttribute("disabled", "disabled");
  try {
    let req = await fetch(`${apiUrll}/likeComment.php?id=${id}`);
    if (!req.ok) throw "Request not found";
    console.log(req);
    await req;
    document.querySelector(`#likeComment_btn_${id}`).style.display = "none";
    document.querySelector(`#unlikeComment_btn_${id}`).style.display = "block";
  } catch (ex) {
    console.log(ex);
  } finally {
    document.querySelector(`#likeComment_btn_${id}`).removeAttribute("disabled");
  }
};

let unlikeComment = async (id) => {
  document
    .querySelector(`#unlikeComment_btn_${id}`)
    .setAttribute("disabled", "disabled");
  try {
    let req = await fetch(`${apiUrll}/unlikeComment.php?id=${id}`);
    if (!req.ok) throw "Request not found";
    console.log(req);
    await req;
    document.querySelector(`#likeComment_btn_${id}`).style.display = "block";
    document.querySelector(`#unlikeComment_btn_${id}`).style.display = "none";
  } catch (ex) {
    console.log(ex);
  } finally {
    document.querySelector(`#unlikeComment_btn_${id}`).removeAttribute("disabled");
  }
};
