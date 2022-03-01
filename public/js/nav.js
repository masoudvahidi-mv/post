function myFunction() {
                var x = document.getElementById("myTopnav1");
                if (x.className === "topnav ") {
                    x.className += " responsive ";
                } else {
                    x.className = "topnav ";
                }
            }