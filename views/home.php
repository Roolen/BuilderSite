<div id="app">
    <main class="main">
        <h1>
            Welcome!
        </h1>
        <div> This site for managing of builder database. </div>

        <div :style="messageColor" class="message"> {{ message }} </div>
        
        <?php if (!$isAuthorize): ?>
            <label for="nameField" class="label">Name</label>
            <input id="nameField"
                v-model="loginFields['name']"
                type="text"
                class="edit-field-login"
                placeholder="Admin?" />
            
            <label for="passwordField" class="label">Password</label>
            <input id="passwordField"
                v-model="loginFields['password']"
                type="password"
                class="edit-field-login"
                placeholder="Admin!" />
                
            <button @click="authorize"
                    type="button"
                    class="login-button">Log In</button>
        <?php else: ?>
            <div class="logout">
                <a href="/home/logout">LogOut</a>
            </div>
        <?php endif ?>
    </main>
</div>
<script src=" <?= $content ?>/js/vue.min.js"></script>
<script src=" <?= $content ?>/js/app.js"></script>