const urlInsertClient = location.protocol + "//" + location.host + "/clients/insert"




const vue = new Vue({
    el: "#app",
    data: {
        isAdding: false,
        message: "",
        messageColor: "color: green;",
        clientFields: [],
    },
    methods: {
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