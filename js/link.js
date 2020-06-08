window.addEventListener("load", function () {
    setTimeout(() => {
        let URL2 = document.getElementsByClassName("size");
        let iFrame = document.querySelector("#iFrame");
        let final = URL2[0].innerText;
        document.querySelector("#dieUrl").innerHTML = final;

        document
            .querySelector("#weiter")
            .addEventListener("click", function () {
                if (final.includes("https://") || final.includes("http://")) {
                    console.log(final);
                    window.location = final;
                } else {
                    console.log("https://" + final);
                    window.location = "https://" + final;
                }
            });
    }, 200);

    setTimeout(() => {
        let URL = document.getElementById("boxField");
        // let URLNeu = Array.from(document.getElementsByTagName("a"))[3].innerHTML;
        let URLnu = Array.from(URL.children)[1];
        let htmlUrl = document.querySelectorAll(".html");
        console.log(htmlUrl);
        let URL2 = document.getElementsByClassName("size");
        let iFrame = document.querySelector("#iFrame");
        let final = URL2[0].innerText;
        console.log(final, iFrame);

        if (final != null) {
            document.querySelector("#iFrame").style.display = "block";
        }

        setTimeout(() => {
            if (final.includes("https://") || final.includes("http://")) {
                iFrame.src = final;
            } else {
                iFrame.src = "https://" + final;
            }
        }, 1000);

        let weiter = document.getElementById("weiter");

        function changeLink() {
            setTimeout(function () {
                let derlink = document.getElementById("derlink");
                derlink.setAttribute("href", final);
            }, 50);
        }
        // let wo = document.getElementById("wo");

        // wo.innerHTML += document.getElementsByClassName("size")[0].innerText;

        // weiter.addEventListener("click", function () {
        //     window.location = document.getElementsByClassName(
        //         "size"
        //     )[0].innerText;
        // });
    }, 2000);
});
