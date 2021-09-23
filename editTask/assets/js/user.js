"use strict";
let apiUrl = "api";

let blockUser = async (id) => {
  document
    .querySelector(`#block_btn_${id}`)
    .setAttribute("disabled", "disabled");
  try {
    let req = await fetch(`${apiUrl}/block.php?id=${id}`);
    if (!req.ok) throw "Request not found";
    console.log(req);
    await req;
    document.querySelector(`#block_btn_${id}`).style.display = "none";
    document.querySelector(`#unblock_btn_${id}`).style.display = "block";
  } catch (ex) {
    console.log(ex);
  } finally {
    document.querySelector(`#block_btn_${id}`).removeAttribute("disabled");
  }
};

let unblockUser = async (id) => {
  document
    .querySelector(`#unblock_btn_${id}`)
    .setAttribute("disabled", "disabled");
  try {
    let req = await fetch(`${apiUrl}/unblock.php?id=${id}`);
    if (!req.ok) throw "Request not found";
    console.log(req);
    await req;
    document.querySelector(`#block_btn_${id}`).style.display = "block";
    document.querySelector(`#unblock_btn_${id}`).style.display = "none";
  } catch (ex) {
    console.log(ex);
  } finally {
    document.querySelector(`#unblock_btn_${id}`).removeAttribute("disabled");
  }
};
