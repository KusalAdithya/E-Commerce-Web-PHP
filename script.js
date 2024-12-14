//sign up & sign in change
function changeView() { 
    var signInBox = document.getElementById("signInBox");
    var signUpBox = document.getElementById("signUpBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");
}
c
//sign up proccess
function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                document.getElementById("msg").innerHTML = "";
                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    };
    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}

function clearp1() {
    document.getElementById("msg").innerHTML = "";
}

function clearp2() {
    document.getElementById("msg2").innerHTML = "";
}

//sign in proccess
function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");

    var remember = document.getElementById("remember");

    var formData = new FormData();
    formData.append("email", email.value);
    formData.append("password", password.value);
    formData.append("remember", remember.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                email.value = "";
                password.value = "";
                document.getElementById("msg2").innerHTML = "";
                window.location = "home.php";
            } else if (t == "1") {
                alert("You are an invalid user");
                window.location = "index.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }
        }
    };

    r.open("POST", "signInProcess.php", true);
    r.send(formData);

}

var bm;
//forgot Password proccess
function forgotPassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                alert("Verification email sent.Please check your index");
                var m = document.getElementById("forgoetPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {

                alert(text);
            }
        }
    };
    r.open("GET", "fogotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function showPassword1() {
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.className == "bi bi-eye") {
        np.type = "text";
        npb.className = "bi bi-eye-slash";
    } else {
        np.type = "password";
        npb.className = "bi bi-eye";
    }

}

function showPassword2() {
    var np = document.getElementById("rnp");
    var npb = document.getElementById("rnpb");

    if (npb.className == "bi bi-eye") {
        np.type = "text";
        npb.className = "bi bi-eye-slash";
    } else {
        np.type = "password";
        npb.className = "bi bi-eye";
    }

}

function showPasswordsignup() {
    var icon = document.getElementById("show1");
    var input = document.getElementById("password");

    if (icon.className == "bi bi-eye") {
        input.type = "text";
        icon.className = "bi bi-eye-slash";
    } else {
        input.type = "password";
        icon.className = "bi bi-eye";
    }

}

function showPasswordsignin() {
    var icon = document.getElementById("show2");
    var input = document.getElementById("password2");

    if (icon.className == "bi bi-eye") {
        input.type = "text";
        icon.className = "bi bi-eye-slash";
    } else {
        input.type = "password";
        icon.className = "bi bi-eye";
    }

}

function resetPassword() {
    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var formData = new FormData();
    formData.append("e", e.value);
    formData.append("np", np.value);
    formData.append("rnp", rnp.value);
    formData.append("vc", vc.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Success") {
                alert("Password Reset Success");
                bm.hide();
            } else {
                alert(text);
            }
        }
    };
    r.open("POST", "resetPassword.php", true);
    r.send(formData);

}

//go to add product
function goToAddProduct() {
    window.location = "addproduct.php";
}

//add product img prev
function changeImg() {

    var image = document.getElementById("imguploder"); //file chooser
    var view = document.getElementById("prev"); //image tag

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;

    }

}

//add product
function addProduct() {
    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");

    var condition;
    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;
    }
    var colour = document.getElementById("clr1");
    // var colour;
    // if (document.getElementById("clr1" + coid).checked) {
    //     var c = document.getElementById("clr1" + coid).checked;
    //     colour = c;
    // } else {
    //     colour = 0;
    // }
    // else if (document.getElementById("clr3").checked) {
    //     colour = 3;
    // } else if (document.getElementById("clr4").checked) {
    //     colour = 4;
    // } else if (document.getElementById("clr5").checked) {
    //     colour = 5;
    // } else if (document.getElementById("clr6").checked) {
    //     colour = 6;
    // }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploder");
    var image1 = document.getElementById("imguploader1");
    var image2 = document.getElementById("imguploader2");

    var form = new FormData();
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("co", condition);
    form.append("col", colour.value);
    form.append("qty", qty.value);
    form.append("p", price.value);
    form.append("dwc", delivery_within_colombo.value);
    form.append("doc", delivery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("img", image.files[0]);
    form.append("img1", image1.files[0]);
    form.append("img2", image2.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);

            if (text == "Product Added Successfully") {
                alert(text);
                window.location = "addproduct.php";
            } else {
                alert(text);
            }
        }
    };
    r.open("POST", "addProductProcess.php", true);
    r.send(form);

}

//sign out proccess
function signOut() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Success") {
                window.location = "home.php";
            }
        }
    };
    r.open("GET", "signout.php", true);
    r.send();
}

// user profile update
function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var postalcode = document.getElementById("postalcode");
    var img = document.getElementById("profileimg");

    var f = new FormData();
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("m", mobile.value);
    f.append("a1", line1.value);
    f.append("a2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", postalcode.value);
    f.append("img", img.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Profile Updated") {
                alert(t);
                window.location = "userprofile.php";
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "UpdateProfileProcess.php", true);
    r.send(f);

}

// profile img prev
function proimgpreview() {
    var image = document.getElementById("profileimg"); //file chooser
    var view = document.getElementById("imgprev"); //image tag

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }

}

//Change Status
function changeStatus(id) {
    var productid = id;
    var statuslabel = document.getElementById("checklabel" + productid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactive") {
                statuslabel.innerHTML = "Make Your Product Active";
            } else if (t == "active") {
                statuslabel.innerHTML = "Make Your Product Deactive";
            }

        }
    };
    r.open("GET", "statusChangeProcess.php?p=" + productid, true);
    r.send();

}

// Delete Model
function deleteModel(id) {

    var dm = document.getElementById("deleteModel" + id);
    k = new bootstrap.Modal(dm);
    k.show();

}

// delete product
function deleteproduct(id) {

    var productid = id;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "success") {
                k.hide();
                window.location = "sellerproductview.php";
            }

        }
    };
    request.open("GET", "deleteproductprocess.php?id=" + productid, true);
    request.send();
}

//filters
function addFilters(x) {

    var page = x;
    var search = document.getElementById("s");

    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    var qty;
    if (document.getElementById("l").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }

    var f = new FormData();
    f.append("p", page);
    f.append("s", search.value);
    f.append("a", age);
    f.append("q", qty);
    f.append("c", condition);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("view").innerHTML = t;

        }
    };
    r.open("POST", "filterProcess.php", true);
    r.send(f);

}

//clear Filters
function clearFilters() {
    window.location = "sellerproductview.php";
}

//search to update
function searchtoupdate() {

    var id = document.getElementById("searchtoupdate").value;
    var title = document.getElementById("ti");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            var object = JSON.parse(text);
            // alert(object["title"]);
            title.value = object["title"]
        }
    };
    r.open("GET", "searchToUpdateProcess.php?id=" + id, true);
    r.send();

}

//send id to update
function sendid(qid) {
    // var id = qid;
    // alert(qid);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            }

        }
    };
    r.open("GET", "sendProductUpdateProcess.php?id=" + qid, true);
    r.send();

}

function changeImg1() {
    var image = document.getElementById("imguploader1"); //file chooser
    var view = document.getElementById("prev1"); //image tag

    image.onchange = function() {
        var file = this.files[0]; //image eka thiyana file path eka
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function changeImg2() {
    var image = document.getElementById("imguploader2"); //file chooser
    var view = document.getElementById("prev2"); //image tag

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

// Update Product Process
function updateProduct() {

    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploder");
    var image1 = document.getElementById("imguploader1");
    var image2 = document.getElementById("imguploader2");

    var form = new FormData();
    form.append("t", title.value);
    form.append("qty", qty.value);
    form.append("dwc", delivery_within_colombo.value);
    form.append("doc", delivery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("img", image.files[0]);
    form.append("img1", image1.files[0]);
    form.append("img2", image2.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

        }
    };
    r.open("POST", "UpdateProductProcess.php", true);
    r.send(form);

}

// load main img
function loadmainimg(id) {

    var pid = id;

    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";

    // alert(img);

}

// qty update
function qty_inc(qty) {

    var pqty = qty;

    var input = document.getElementById("qtyinput");

    if (input.value < pqty) {
        var newvalue = parseInt(input.value) + 1;

        input.value = newvalue.toString();
    } else {
        alert("Maximum quantity count has been achieved");
    }

}

function qty_dec() {
    var input = document.getElementById("qtyinput");

    if (input.value > 1) {

        var newvalue = parseInt(input.value) - 1;

        input.value = newvalue.toString();

    } else {
        alert("Minimum quantity count has been achieved");

    }

}

//basic search
function basicSearch(p) {

    var page = p;
    var searchText = document.getElementById("basic_search_text").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    if (searchText == 0 && searchSelect == 0) {
        alert("Please enter you want to search");
        window.location = "home.php";
    }
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("pview").innerHTML = t;

        }
    };
    r.open("GET", "basicSearchProcess.php?t=" + searchText + "&s=" + searchSelect + "&p=" + page, true);
    r.send();

}

//add to watchlist
function addToWatchlist(id) {
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("Please sign in first");
                window.location = "index.php";
            } else if (t == "success") {
                window.location = "watchlist.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addToWatchlistProcess.php?id=" + pid, true);
    r.send();

}

//deletefromwatchlist
function deletefromwatchlist(id) {
    var wid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "watchlist.php";
            }

        }
    };
    r.open("GET", "removeWatchlistItemProcess.php?id=" + wid, true);
    r.send();
}

//go to cart
function goToCart() {
    window.location = "cart.php";
}

//add to cart
function addToCart(id) {

    var qtytxt = document.getElementById("qtytxt" + id).value;
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("Please sign in first");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please Update your Profile First");
                window.location = "userprofile.php";
            } else if (t == "success") {
                window.location = "cart.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();

}

//delete from Cart
function deletefromCart(id) {

    var cid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            }

        }
    };
    r.open("GET", "deletefromCartProcess.php?id=" + cid, true);
    r.send();

}

//pay now
function paynow(id) {

    var qty = document.getElementById("qtyinput").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["email"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please sign in first");
                window.location = "index.php";
            } else
            if (t == "2") {
                alert("Please Update your Profile First");
                window.location = "userprofile.php";
            } else {

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);

                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218041", // Replace your Merchant ID
                    "return_url": "http://localhost/myeshop/singleproductview.php?id=" + id, // Important
                    "cancel_url": "http://localhost/myeshop/singleproductview.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked

                // document.getElementById('payhere-payment').onclick = function(e) {
                payhere.startPayment(payment);
                // };

            }

        }
    };
    r.open("GET", "buynowprocess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

//save Invoice
function saveInvoice(orderId, id, mail, amount, qty) {

    var orderid = orderId;
    var pid = id;
    var email = mail;
    var total = amount;
    var pqty = qty;

    var f = new FormData();
    f.append("oid", orderid);
    f.append("pid", pid);
    f.append("email", email);
    f.append("total", total);
    f.append("pqty", pqty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            }

        }
    };
    r.open("POST", "saveinvoice.php", true);
    r.send(f);

}

//invoice print
function printDiv() {

    var restorepage = document.body.innerHTML;
    var page = document.getElementById("GFG").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;


}

// cart qty
function cartqty(id) {
    // var mail = email;
    // alert("ok");
    // alert(id);
    var qtytxt = document.getElementById("qtyinput" + id).value;
    // var pid = id;
    // alert(qtytxt);
    // alert(pid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                // window.location = "cart.php";
                document.getElementById("qtyinput" + id).value = qtytxt;
                // reloadcart();
                $(document).ready(function() {
                    setInterval(function() {
                        $("#here").load(window.location.href + " #here");
                        $("#heret").load(window.location.href + " #heret");
                        $("#herer1" + id).load(window.location.href + " #herer1" + id);
                        $("#herer2" + id).load(window.location.href + " #herer2" + id);
                        $("#herer3" + id).load(window.location.href + " #herer3" + id);
                        $("#hereb").load(window.location.href + " #hereb");

                    }, 1000);
                });

            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "cartqtyProcess.php?id=" + id + "&txt=" + qtytxt, true);
    r.send();
}

// function reloadcart() {
//     // alert("okkk");
//     setInterval(function() {
//         // // refreshmsgare(email);
//         document.getElementById("Summary").;
//         // alert("okkkqqq");

//     }, 500);
// }


function CHECKOUT(price) {

    // alert("ko");
    var price = price;
    // alert(price);
    // var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["email"];
            var amount = obj["amount"];
            var price1 = obj["total"];
            // alert("ok");
            // if (t == "1") {
            //     alert("Please sign in first");
            //     window.location = "index.php";
            // } else {

            // Called when user completed the payment. It can be a successful payment or failure
            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);

                saveInvoiceCart(orderId, mail, amount, price1);

            };

            // Called when user closes the payment without completing
            payhere.onDismissed = function onDismissed() {
                console.log("Payment dismissed");
            };

            // Called when error happens when initializing payment such as invalid parameters
            payhere.onError = function onError(error) {
                console.log("Error:" + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1218041", // Replace your Merchant ID
                "return_url": "http://localhost/myeshop/cart.php", // Important
                "cancel_url": "http://localhost/myeshop/cart.php", // Important
                "notify_url": "http://sample.com/notify",
                "order_id": obj["id"],
                // "items": obj["item"],
                "items": "CHECKOUT",
                "amount": price1 + ".00",
                "currency": "LKR",
                "first_name": obj["fname"],
                "last_name": obj["lname"],
                "email": mail,
                "phone": obj["mobile"],
                "address": obj["address"],
                "city": obj["city"],
                "country": "Sri Lanka",
                "delivery_address": obj["address"],
                "delivery_city": obj["city"],
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            // Show the payhere.js popup, when "PayHere Pay" is clicked

            // document.getElementById('payhere-payment').onclick = function(e) {
            payhere.startPayment(payment);
            // };

            // }

        }
    };
    r.open("GET", "cartCheckout.php?p=" + price, true);
    r.send();

}


//save Invoice Cart
function saveInvoiceCart(orderId, mail, price1) {

    // alert(orderId);
    // alert(mail);
    // alert(amount);
    // alert(price1);

    var orderid = orderId;
    // var pid = id;
    var email = mail;
    // var total = amount;
    var totalfull = price1;
    // var pqty = qty;

    var f = new FormData();
    f.append("oid", orderid);
    // f.append("pid", pid);
    f.append("email", email);
    // f.append("total", total);
    f.append("totalfull", totalfull);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                // alert(t);

                window.location = "invoice.php?id=" + orderId;

            }
            // alert(t);

        }
    };
    r.open("POST", "saveinvoiceCart.php", true);
    r.send(f);

}


//Feedback
var k;

function addFeedback(id) {
    var feedmodel = document.getElementById("feedbackModal" + id);
    k = new bootstrap.Modal(feedmodel);
    k.show();

}

//save feedback
function saveFeedback(id) {

    var pid = id;
    var feedtxt = document.getElementById("feedtxt").value;

    var f = new FormData();
    f.append("i", pid);
    f.append("ft", feedtxt);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                k.hide();
            }

        }
    };
    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);

}

// admin verification
function adminverification() {
    var e = document.getElementById("e").value;

    var f = new FormData();
    f.append("e", e);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var verificationModal = document.getElementById("verificationModal");
                k = new bootstrap.Modal(verificationModal);
                k.show();
            } else {
                alert(t);
            }

        }
    };
    r.open("POST", "adminverificationProcess.php", true);
    r.send(f);
}

// verify

function verify() {
    var verification = document.getElementById("v").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "verificationProcess.php?v=" + verification, true);
    r.send();

}

function blockuser(email) {
    var mail = email;
    var blockbtn = document.getElementById("blockbtn" + mail);

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t == "success2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            }

        }
    };
    r.open("POST", "userBlockProcess.php", true);
    r.send(f);

}

//search User
function searchUser1() {

    var text = document.getElementById("searchtxt").value;
    // alert(text);
    // alert("ok");
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // if (t == "success") {
            // window.location = "manageusers.php";
            document.getElementById("view1").innerHTML = t;
            // alert(t);
            // } else {
            //     alert(t);
            // }
            // alert(t);
            // document.getElementById("div").innerHTML = t;

        }
    };
    r.open("GET", "searchuser.php?s=" + text, true);
    r.send();
}



//     var r = new XMLHttpRequest();
//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             var t = r.responseText;
//             if (t == "You must enter a keyword to search") {
//                 alert(t);
//             } else {
//                 viewResults.innerHTML = t;
//             }

//         }
//     };
//     r.open("POST", "advancedSearchProcess.php", true);
//     r.send(f);

// }


function advancedSearch(x) {

    var s = document.getElementById("s1").value;
    var ca = document.getElementById("ca1").value;
    var br = document.getElementById("br1").value;
    var mo = document.getElementById("mo1").value;
    var co = document.getElementById("co1").value;
    var col = document.getElementById("col1").value;
    var prif = document.getElementById("prif1").value;
    var prit = document.getElementById("prit2").value;
    var sort = document.getElementById("sort").value;

    var form = new FormData();
    form.append("page", x);
    form.append("s", s);
    form.append("c", ca);
    form.append("b", br);
    form.append("m", mo);
    form.append("co", co);
    form.append("col", col);
    form.append("prif", prif);
    form.append("prit", prit);
    form.append("sort", sort);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            document.getElementById("filter").innerHTML = text;
        }
    };
    r.open("POST", "advancedSearchpro.php", true);
    r.send(form);

}

//daily sellings
function dailysellings() {

    var from = document.getElementById("fromdate").value;
    var to = document.getElementById("todate").value;
    var link = document.getElementById("historylink");

    link.href = "sellinghistory.php?f=" + from + "&t=" + to;

}

// function Scrolldown() {
//     window.scroll(0, 20);
// }

function viewmsgmodalu(email) {

    var pop = document.getElementById("mesgmodal");

    k = new bootstrap.Modal(pop);
    k.show();

    refresher(email);


}

//view msg modal
function viewmsgmodal(email) {

    var pop = document.getElementById("mesgmodal" + email);

    k = new bootstrap.Modal(pop);
    k.show();

    admin_refresher(email);

}

// manage product category modal
function addnewmodal() {
    var pop = document.getElementById("addnewmodal");

    k = new bootstrap.Modal(pop);
    k.show();

}

// save category
function savecategory() {

    var txt = document.getElementById("categorytxt").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                alert("Category saved successfully");
                window.location = "addnewcategory.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addNewCategoryProcess.php?t=" + txt, true);
    r.send();

}

//single view modal
function singleviewmodal(id) {

    var pop = document.getElementById("singleproductview" + id);

    k = new bootstrap.Modal(pop);
    k.show();

}

// block product admin
function blockproduct(id) {
    var pid = id;
    var blockbtn = document.getElementById("blockbtn" + id);

    var f = new FormData();
    f.append("pid", pid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success1") {
                blockbtn.className = "btn btn-success";
                blockbtn.innerHTML = "Unblock";
            } else if (t == "success2") {
                blockbtn.className = "btn btn-danger";
                blockbtn.innerHTML = "Block";
            }

        }
    };
    r.open("POST", "productBlockProcess.php", true);
    r.send(f);

}

// sendmessage
function sendmessage(mail) {

    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                document.getElementById("msgtxt").value = "";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}

// refresher

function refresher(email) {

    setInterval(function() {
        refreshmsgare(email);
    }, 500);

    setInterval(function() {
        refreshrecentarea();
    }, 500);
}

// refres msg view area

function refreshmsgare(mail) {

    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            chatrow.innerHTML = t;

        }
    };

    r.open("POST", "refreshmsgareaprocess.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
        }
    };

    r.open("POST", "refreshrecentareaprocess.php", true);
    r.send();

}

// admin sendmessage
function admin_sendmessage(email) {

    var email = email;
    var msgtxt = document.getElementById("msgtxt" + email).value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                document.getElementById("msgtxt" + email).value = "";
            } else {
                alert(t);
            }
        }
    };

    r.open("POST", "admin_sendmessageprocess.php", true);
    r.send(f);

}

function admin_refresher(email) {

    setInterval(function() {
        admin_refreshmsgare(email);
    }, 500);

    setInterval(function() {
        admin_refreshrecentarea(email);
    }, 500);
}

//admin refres msg view area

function admin_refreshmsgare(email) {

    var chatrow = document.getElementById("chatrow" + email);

    var f = new FormData();
    f.append("e", email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            chatrow.innerHTML = t;

        }
    };

    r.open("POST", "admin_refreshmsgareaprocess.php", true);
    r.send(f);

}

//admin refreshrecentarea

function admin_refreshrecentarea(email) {

    var rcv = document.getElementById("rcv" + email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
        }
    };

    r.open("POST", "admin_refreshrecentareaprocess.php", true);
    r.send();

}

function selectcolor(mbid) {
    var color = document.getElementById("selectcolor").value;
    // var mb = mbid;

    window.location = "colorciew.php?c=" + color + "&mb=" + mbid;

    // var form = new FormData();
    // form.append("c", color);
    // form.append("mb", mb);

    // var r = new XMLHttpRequest();
    // r.onreadystatechange = function() {
    //     if (r.readyState == 4) {
    //         var text = r.responseText;

    //         document.getElementById("cview").innerHTML = text;
    //     }
    // };
    // r.open("POST", "colorciew.php", true);
    // r.send(form);

}

//add to cart
function addToCartsingle1(id) {

    var qtytxt = document.getElementById("qtyinput").value;
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "1") {
                alert("Please sign in first");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please Update your Profile First");
                window.location = "userprofile.php";
            } else if (t == "success") {
                window.location = "cart.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();

}

function view(id) {

    var pid = id;

    // var r = new XMLHttpRequest();
    // r.onreadystatechange = function() {
    //     if (r.readyState == 4) {
    //         var t = r.responseText;
    // if (t == "success") {
    window.location = "singleproductview.php?id=" + pid;
    // } else {
    //     alert(t);
    // }

    // }
    // };
    // r.open("GET", "singleproductview.php?id=" + pid, true);
    // r.send();

}

function purchasedelete(id) {
    // alert(id);

    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "purchasehistory.php";
            }

        }
    };
    r.open("GET", "deletefromPurchaseProcess.php?id=" + pid, true);
    r.send();
}
// var p;
// manage product category b
function addnewmodalb() {
    var pop = document.getElementById("addnewmodalb");

    k = new bootstrap.Modal(pop);
    k.show();
}

function savebrand() {

    var txt = document.getElementById("brandtxt").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                alert("Brand saved successfully");
                window.location = "addnewcategory.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addNewBrandProcess.php?t=" + txt, true);
    r.send();

}

function addnewmodalm() {
    var pop = document.getElementById("addnewmodalm");

    k = new bootstrap.Modal(pop);
    k.show();
}

function savemodel() {

    var txt = document.getElementById("modeltxt").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                alert("Model saved successfully");
                window.location = "addnewcategory.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addNewModelProcess.php?t=" + txt, true);
    r.send();

}

function addmodelbrand() {

    var brand = document.getElementById("br");
    var model = document.getElementById("mo");

    var form = new FormData();
    form.append("b", brand.value);
    form.append("m", model.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);

            if (text == "1") {
                alert("Model has Brand Added Successfully");
                window.location = "addnewcategory.php";
            } else {
                alert(text);
            }
        }
    };
    r.open("POST", "addModelBrandProcess.php", true);
    r.send(form);

}

function addnewmodalc() {
    var pop = document.getElementById("addnewmodalc");

    k = new bootstrap.Modal(pop);
    k.show();
}

function savecolour() {

    var txt = document.getElementById("colortxt").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                alert("Colour saved successfully");
                window.location = "addnewcategory.php";
            } else {
                alert(t);
            }

        }
    };
    r.open("GET", "addNewColorProcess.php?t=" + txt, true);
    r.send();

}