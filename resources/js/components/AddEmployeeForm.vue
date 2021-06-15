<template>
    <div class="card auto-card">
        <div class="container">
            <form action="">
                <div class="form-header">
                    <b-icon icon="user-friends" size="is-small">></b-icon>
                    <h1 class="subtitle">
                        Add new employee
                    </h1>
                </div>
                <div class="form-body">
                   <div class="wrapper">
                        <div class="columns">
                            <div class="column is-flex is-align-items-center">
                                <b-field label="Email"
                                        type="is-danger"
                                        message="This email is invalid">
                                        <b-input type="email"
                                            maxlength="30">
                                        </b-input>
                                </b-field>
                                <b-button type="is-link">Send</b-button>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="form-footer">
                    
                </div>
                
            </form>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>