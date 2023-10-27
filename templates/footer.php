        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <script>
            // Function to delete a cookie by name
            function deleteCookie(name) {
                document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
            }

            // Check if the cookie exists
            var messageCookie = getCookie("message");
            console.log(messageCookie);
            if (messageCookie) {
                alert(messageCookie); // Show the alert with the message
                deleteCookie("message"); // Delete the cookie
            }

            // Function to get a cookie by name
            function getCookie(name) {
                var value = "; " + document.cookie;
                var parts = value.split("; " + name + "=");
                if (parts.length == 2) return parts.pop().split(";").shift();
            }
        </script>

    </body>
</html>