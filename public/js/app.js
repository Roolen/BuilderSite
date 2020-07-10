const baseUrl = location.protocol + "//" + location.host + "/"
const urlInsertClient = baseUrl + "clients/insert"
const urlAuthorize = baseUrl + "home/authorize"




const vue = new Vue({
    el: "#app",
    data: {
        isAdding: false,
        message: "",
        messageColor: "color: green;",
        loginFields: [],
        clientFields: [],
    },
    methods: {
        authorize: async () => {
            try {

                const response = await fetch(urlAuthorize, {
                    method: "POST",
                    body: JSON.stringify({
                        name: vue.loginFields['name'],
                        password: vue.loginFields['password']
                    })
                })

                const body = await response.json()

                console.log(body)

                if (body.complete) {
                    vue.message = "Authorize is complete."
                    vue.messageColor = "color: green;"
                    location.reload()
                }
                else {
                    vue.message = "Wrong login and password."
                    vue.messageColor = "color: red;"
                }

                setTimeout(() => { vue.message = "" }, 5_000)
            }
            catch (e) {
                console.log(e)
            }
        },
        insertClient: async () => {
            try {
                const response = await fetch(urlInsertClient, {
                    method: "POST",
                    body: JSON.stringify({
                        first_name: vue.clientFields['first_name'],
                        middle_name: vue.clientFields['middle_name'],
                        last_name: vue.clientFields['last_name'],
                        address: vue.clientFields['address'],
                        phone: vue.clientFields['phone']
                    })
                })

                const body = await response.json()

                console.log(body)

                if (body.complete) {
                    vue.message = "Adding complete."
                }
                else {
                    vue.message = "Adding failure."
                    vue.messageColor = "color: red;"
                }

                setTimeout(() => { vue.message = "" }, 5_000)

            }
            finally {
                vue.isAdding = false
            }
        }
    }
})