<div class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 flex flex-col items-center justify-center p-4 py-8">
    <div class="w-full max-w-2xl">
        <!-- Logo & Title -->
        <div class="text-center mb-6">
            <img src="<?php echo base_url(); ?>assets/images/PN_Logo.png"
                 class="w-20 h-20 mx-auto rounded-2xl shadow-lg mb-3" alt="PNC Internship Follow-up">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Internship Follow-up System</h1>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-8 pt-6 pb-2 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-700">Create account</h3>
                <p class="text-sm text-gray-400 mt-0.5">Create your student account to get started</p>
            </div>
            <div class="p-8">
                <?php if ((isset($flash_partial_view) && $flash_partial_view <> '') || validation_errors() <> '') { ?>
                <div class="text-sm text-red-600 space-y-1 mb-4">
                    <?php echo (isset($flash_partial_view) && $flash_partial_view <> '') ? $flash_partial_view : ''; ?>
                    <?php echo validation_errors(); ?>
                </div>
                <?php } ?>
                <?php
                $attributes = array('id' => 'register', 'class' => '');
                echo form_open('connection/register_student', $attributes);
                ?>
                <fieldset class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="firstname">First Name</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Enter your first name" name="firstname" id="firstname" value="<?php echo set_value('firstname'); ?>" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="lastname">Last Name</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Enter your last name" name="lastname" id="lastname" value="<?php echo set_value('lastname'); ?>" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="pnemail">PN Email</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="you@student.passerellesnumeriques.org" type="email" name="pnemail" id="pnemail" value="<?php echo set_value('pnemail'); ?>" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="personnalemail">Personal Email</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="you@gmail.com" type="email" name="personnalemail" id="personnalemail" value="<?php echo set_value('personnalemail'); ?>" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="password">Password</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Enter a password" type="password" name="password" id="password" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="password2">Retype Password</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Retype the password" type="password" name="password2" id="password2" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="skypeid">Skype ID</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Enter your skype id" type="text" name="skypeid" id="skypeid" value="<?php echo set_value('skypeid'); ?>" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="batchcode">Batch Code</label>
                        <input class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Enter your batch code" type="text" name="batchcode" id="batchcode" value="<?php echo set_value('batchcode'); ?>" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1.5" for="major">Major</label>
                        <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                id="major" name="major" required>
                            <option value="WEP" <?php echo set_select('major', 'WEP', TRUE); ?>>WEP</option>
                            <option value="SNA" <?php echo set_select('major', 'SNA'); ?>>SNA</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 pt-2">
                        <button id="send" type="submit" form="register"
                                class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm transition shadow-sm hover:shadow">
                            Create account
                        </button>
                        <a href="<?php echo base_url(); ?>"
                           class="block w-full mt-3 py-2.5 bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 font-semibold rounded-lg text-sm text-center transition">
                            Back to sign in
                        </a>
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
        <p class="text-center text-xs text-gray-400 mt-6">Passerelles Numériques &copy; 2024</p>
    </div>
</div>
