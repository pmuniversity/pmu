<footer class="common-section" style="background-color: #333;">
    <div class="container">
        <h2>LIKE WHAT YOU SEE?</h2>
        <h4>Like what you see?</h4>

        <div class="contact-us">
            <div class="contact-us-form">
                <form action="/user" method="post"
                      v-on:submit.prevent="submitForm">
                    {!! csrf_field() !!}
                    <input type="text" name="email" id="email"
                           class="email-input" placeholder="Send us an email"
                           v-model="formInputs.email"/>
                    <input type="submit" name="submit" class="submit-button" value="Send" :disabled="disabledButton"/>
                    <span class="required-field"></span>
                </form>
                <div v-if="successMessage" class="success-message">@{{ successMessage }}
                </div>
                <div v-if="formErrors" class="success-message">@{{ formErrors[0] }}
                </div>
            </div>
            <ul class="social-list">
                <li class="social-icon facebook"><a href="#" target="_blank"></a></li>
                <li class="social-icon twitter"><a href="#" target="_blank"></a></li>
                <li class="social-icon linkedin"><a href="#" target="_blank"></a></li>
                <li class="social-icon gmail"><a href="#" target="_blank"></a></li>
            </ul>
        </div>

    </div>
</footer>