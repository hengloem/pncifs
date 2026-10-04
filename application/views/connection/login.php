<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 flex flex-col items-center justify-center p-4 py-8">
    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-6">
            <img src="<?php echo base_url(); ?>assets/images/PN_Logo.png"
                 class="w-20 h-20 mx-auto rounded-2xl shadow-lg mb-3" alt="PNC Internship Follow-up">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Internship Follow-up System</h1>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-8 pt-6 pb-2 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-700">Sign In</h3>
                <p class="text-sm text-gray-400 mt-0.5">Enter your credentials to continue</p>
            </div>
            <div class="p-8">
                <?php echo (isset($flash_partial_view) && $flash_partial_view <> '') ? $flash_partial_view : ''; ?>
                <?php echo validation_errors(); ?>
                <?php
                $attributes = array('id' => 'loginFrom', 'class' => '');
                echo form_open('connection/login', $attributes);
                ?>
                <input type="hidden" name="last_page" value="connection/login" />
                <fieldset class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="login">Email</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Enter your email" autofocus="" name="email" id="login"
                               value="<?php echo set_value('email'); ?>">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="password">Password</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Enter your password" name="password" id="password" value="" type="password">
                    </div>
                    <button id="send" type="submit" form="loginFrom"
                            class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm
                                   transition shadow-sm hover:shadow">
                        Login
                    </button>
                    <a href="<?php echo base_url(); ?>connection/register_student"
                       class="block w-full py-2.5 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 font-semibold
                              rounded-lg text-sm text-center transition">
                        Register as student
                    </a>
                </fieldset>
                </form>
            </div>
        </div>
        <p class="text-center text-xs text-gray-400 mt-6">Passerelles Numériques &copy; 2024</p>
    </div>
</div>
