"use strict";
let apiUrlll = "users/api";

let followUser = async (id) => {
  document
    .querySelector(`#follow_btn_${id}`)
    .setAttribute("disabled", "disabled");
  try {
    let req = await fetch(`${apiUrlll}/follow.php?id=${id}`);
    if (!req.ok) throw "Request not found";
    console.log(req);
    await req;
    document.querySelector(`#follow_btn_${id}`).style.display = "none";
    document.querySelector(`#unfollow_btn_${id}`).style.display = "block";
  } catch (ex) {
    console.log(ex);
  } finally {
    document.querySelector(`#follow_btn_${id}`).removeAttribute("disabled");
  }
};

let unfollowUser = async (id) => {
  document
    .querySelector(`#unfollow_btn_${id}`)
    .setAttribute("disabled", "disabled");
  try {
    let req = await fetch(`${apiUrlll}/unfollow.php?id=${id}`);
    if (!req.ok) throw "Request not found";
    console.log(req);
    await req;
    document.querySelector(`#follow_btn_${id}`).style.display = "block";
    document.querySelector(`#unfollow_btn_${id}`).style.display = "none";
  } catch (ex) {
    console.log(ex);
  } finally {
    document.querySelector(`#unfollow_btn_${id}`).removeAttribute("disabled");
  }
};
