let auth =
  localStorage.getItem("type_token") +
  " " +
  localStorage.getItem("access_token");
let headers = {
  Authorization: auth,
};

export default {
    headers
}