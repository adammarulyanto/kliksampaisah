<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verifikasi Email — Invita</title>
  <link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css" />
  <style>
    /* ── OTP Input ───────────────────────────────────────── */
    .otp-group {
      display: flex;
      gap: 10px;
      justify-content: center;
      margin: 8px 0;
    }

    .otp-input {
      width: 52px;
      height: 60px;
      text-align: center;
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--dark);
      background: var(--white);
      border: 2px solid var(--grey-200);
      border-radius: 12px;
      outline: none;
      transition: var(--transition);
      caret-color: var(--orange);
    }

    .otp-input:focus {
      border-color: var(--orange);
      box-shadow: 0 0 0 3px rgba(255,122,47,0.12);
      transform: translateY(-2px);
    }

    .otp-input.filled {
      border-color: var(--orange);
      background: rgba(255,122,47,0.04);
    }

    .otp-input.error {
      border-color: var(--coral);
      background: rgba(240,58,46,0.04);
      animation: shake 0.4s ease;
    }

    .otp-input.success {
      border-color: #3aab6d;
      background: rgba(58,171,109,0.06);
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20%       { transform: translateX(-6px); }
      40%       { transform: translateX(6px); }
      60%       { transform: translateX(-4px); }
      80%       { transform: translateX(4px); }
    }

    /* ── Email badge ─────────────────────────────────────── */
    .email-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--cream);
      border: 1px solid rgba(255,122,47,0.2);
      border-radius: 100px;
      padding: 7px 16px 7px 10px;
      font-size: 13px;
      font-weight: 600;
      color: var(--dark);
      margin: 4px auto;
    }

    .email-badge-icon {
      width: 28px;
      height: 28px;
      background: var(--orange);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      flex-shrink: 0;
    }

    /* ── Status Messages ─────────────────────────────────── */
    .otp-status {
      text-align: center;
      font-size: 13px;
      font-weight: 500;
      min-height: 20px;
      transition: var(--transition);
    }

    .otp-status.error-msg { color: var(--coral); }
    .otp-status.success-msg { color: #3aab6d; }

    /* ── Resend section ──────────────────────────────────── */
    .resend-row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      font-size: 13px;
      color: var(--grey-600);
    }

    .resend-btn {
      background: none;
      border: none;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 700;
      color: var(--orange);
      cursor: pointer;
      padding: 0;
      transition: var(--transition);
    }

    .resend-btn:hover:not(:disabled) { color: var(--coral); text-decoration: underline; }
    .resend-btn:disabled { color: var(--grey-400); cursor: default; text-decoration: none; }

    .countdown-timer {
      font-weight: 700;
      color: var(--orange);
      font-variant-numeric: tabular-nums;
      min-width: 32px;
    }

    /* ── Progress dots ───────────────────────────────────── */
    .step-dots {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-bottom: 32px;
    }

    .step-dot {
      height: 6px;
      border-radius: 3px;
      transition: all 0.3s ease;
      background: var(--grey-200);
    }

    .step-dot.done  { width: 20px; background: var(--orange); }
    .step-dot.active { width: 28px; background: var(--orange); opacity: 0.7; }
    .step-dot.pending { width: 6px; }

    /* ── Visual panel illustration override ─────────────── */
    .verify-illustration {
      position: relative;
      width: 260px;
      height: 260px;
      margin: 0 auto 40px;
    }

    .verify-envelope {
      width: 200px;
      background: white;
      border-radius: 16px;
      padding: 28px 24px 24px;
      box-shadow: 0 16px 48px rgba(0,0,0,0.13);
      text-align: center;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 3;
    }

    .verify-envelope-icon {
      font-size: 42px;
      display: block;
      margin-bottom: 12px;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50%       { transform: translateY(-8px); }
    }

    .verify-envelope-code {
      display: flex;
      gap: 5px;
      justify-content: center;
      margin-bottom: 10px;
    }

    .vcode-box {
      width: 28px;
      height: 34px;
      background: var(--cream);
      border: 1.5px solid rgba(255,122,47,0.25);
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Playfair Display', serif;
      font-size: 15px;
      font-weight: 700;
      color: var(--orange);
    }

    .vcode-box.blink {
      animation: blink-border 1.2s ease-in-out infinite;
    }

    @keyframes blink-border {
      0%, 100% { border-color: rgba(255,122,47,0.25); }
      50%       { border-color: var(--orange); background: rgba(255,122,47,0.06); }
    }

    .verify-envelope-label {
      font-size: 11px;
      color: var(--grey-400);
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    /* Floating sparkles */
    .sparkle {
      position: absolute;
      font-size: 18px;
      animation: sparkle-float 2.5s ease-in-out infinite;
      opacity: 0.7;
    }

    .sparkle:nth-child(1) { top: 10px; right: 20px; animation-delay: 0s; }
    .sparkle:nth-child(2) { bottom: 30px; left: 10px; animation-delay: 0.6s; font-size: 14px; }
    .sparkle:nth-child(3) { top: 40px; left: 15px; animation-delay: 1.2s; font-size: 12px; }

    @keyframes sparkle-float {
      0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.7; }
      50%       { transform: translateY(-10px) rotate(15deg); opacity: 1; }
    }

    /* ── Success overlay ─────────────────────────────────── */
    .success-overlay {
      position: absolute;
      inset: 0;
      background: var(--white);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 12px;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.4s ease;
      border-radius: inherit;
    }

    .success-overlay.show {
      opacity: 1;
      pointer-events: all;
    }

    .success-checkmark {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, var(--orange), var(--coral));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      animation: pop-in 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes pop-in {
      0%   { transform: scale(0); }
      80%  { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    .success-text-title {
      font-family: 'Playfair Display', serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--dark);
    }

    .success-text-sub {
      font-size: 13px;
      color: var(--grey-600);
      text-align: center;
      max-width: 280px;
      line-height: 1.6;
    }
  </style>
</head>
<body>

<div class="login-page">

  <!-- ── Left Visual Panel ─────────────────────────── -->
  <div class="login-visual">
    <div class="visual-content">

      <div class="visual-logo">Invi<span>ta</span></div>

      <!-- Email verification illustration -->
      <div class="verify-illustration">
        <span class="sparkle">✦</span>
        <span class="sparkle">✧</span>
        <span class="sparkle">✦</span>

        <div class="verify-envelope">
          <span class="verify-envelope-icon">📧</span>
          <div class="verify-envelope-code">
            <div class="vcode-box">4</div>
            <div class="vcode-box">8</div>
            <div class="vcode-box">3</div>
            <div class="vcode-box blink">_</div>
            <div class="vcode-box" style="opacity:0.3;">_</div>
            <div class="vcode-box" style="opacity:0.3;">_</div>
          </div>
          <div class="verify-envelope-label">Kode verifikasi</div>
        </div>
      </div>

      <p class="visual-tagline">
        Hampir selesai,<br>
        <em>tinggal selangkah!</em>
      </p>
      <p class="visual-sub">
        Kami mengirimkan kode 6 digit ke emailmu.<br>
        Periksa juga folder spam kalau tidak ketemu.
      </p>

    </div>
  </div>

  <!-- ── Right Form Panel ──────────────────────────── -->
  <div class="login-panel">
    <div class="login-form-wrap">

      <!-- Mobile logo -->
      <div class="visual-logo" id="mobileLogo" style="display:none; margin-bottom:32px; font-size:22px;">
        Invi<span style="color:var(--orange);">ta</span>
      </div>

      <!-- Step indicator -->
      <div class="step-dots">
        <div class="step-dot done"></div>
        <div class="step-dot done"></div>
        <div class="step-dot active"></div>
        <div class="step-dot pending"></div>
      </div>

      <div class="form-header">
        <h1>Cek emailmu</h1>
        <p>Kode verifikasi sudah dikirim ke</p>
      </div>

      <!-- Email badge -->
      <div style="margin-bottom: 28px;">
        <div class="email-badge">
          <div class="email-badge-icon">✉️</div>
          <span id="emailDisplay"><?=session()->get('temp_email')?></span>
        </div>
        <div style="text-align:center; margin-top: 8px;">
          <a href="#" style="font-size:12px; color:var(--grey-400);" id="changeEmailBtn">Bukan kamu? Ganti email</a>
        </div>
      </div>

      <!-- OTP form -->
      <form id="otpForm" action="<?=base_url('verify')?>" method="post">

        <div style="margin-bottom: 8px;">
          <div style="font-size:13px; font-weight:600; color:var(--grey-600); margin-bottom:12px; text-align:center; letter-spacing:0.03em;">
            Masukkan kode 6 digit
          </div>
          <!-- OTP boxes -->
          <div class="otp-group">
            <input class="otp-input" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" autocomplete="one-time-code" id="otp0" />
            <input class="otp-input" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="otp1" />
            <input class="otp-input" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="otp2" />
            <input class="otp-input" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="otp3" />
            <input class="otp-input" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="otp4" />
            <input class="otp-input" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" id="otp5" />
          </div>
          <input type="hidden" name="code" id="codeHidden" />
        </div>

        <!-- Status message -->
        <div class="otp-status" id="otpStatus"></div>

        <!-- Submit -->
        <button type="submit" class="btn-primary login-submit" id="verifyBtn" style="margin-top: 20px;" disabled>
          Verifikasi Email
        </button>

        <!-- Resend -->
        <div class="resend-row" style="margin-top: 20px;">
          <span>Tidak menerima kode?</span>
          <button type="button" class="resend-btn" id="resendBtn" disabled>
            Kirim ulang (<span class="countdown-timer" id="countdown">60</span>)
          </button>
        </div>

      </form>

      <!-- Success overlay (hidden, shown after verify) -->
      <div class="success-overlay" id="successOverlay">
        <div class="success-checkmark">✓</div>
        <div class="success-text-title">Email Terverifikasi!</div>
        <div class="success-text-sub">Akunmu sudah aktif. Kamu akan diarahkan ke dashboard dalam beberapa detik...</div>
        <a href="dashboard.html" class="btn-primary" style="margin-top: 8px; padding: 12px 28px; font-size: 14px;">
          Ke Dashboard →
        </a>
      </div>

      <p style="margin-top: 28px; font-size: 12px; color: var(--grey-400); text-align: center; line-height: 1.7;">
        Butuh bantuan?
        <a href="#" style="color: var(--orange); font-weight:600;">Hubungi Support</a>
      </p>

    </div>
  </div>

</div>

<script>
  // ── Mobile logo ─────────────────────────────────────────
  function checkLayout() {
    const ml = document.getElementById('mobileLogo');
    ml.style.display = window.innerWidth <= 900 ? 'block' : 'none';
  }
  checkLayout();
  window.addEventListener('resize', checkLayout);

  // ── OTP Input logic ──────────────────────────────────────
  const inputs = Array.from(document.querySelectorAll('.otp-input'));
  const verifyBtn = document.getElementById('verifyBtn');
  const otpStatus = document.getElementById('otpStatus');

  // Focus first input on load
  setTimeout(() => inputs[0].focus(), 300);

  function getOTPValue() {
    return inputs.map(i => i.value).join('');
  }

  function checkComplete() {
    const val = getOTPValue();
    const complete = val.length === 6 && /^\d{6}$/.test(val);
    verifyBtn.disabled = !complete;
    return complete;
  }

  function setInputState(state) {
    // state: 'error' | 'success' | 'default'
    inputs.forEach(inp => {
      inp.classList.remove('error', 'success', 'filled');
      if (state !== 'default') inp.classList.add(state);
      else if (inp.value) inp.classList.add('filled');
    });
  }

  inputs.forEach((input, idx) => {
    input.addEventListener('input', e => {
      // Only digits
      input.value = input.value.replace(/\D/g, '').slice(-1);

      if (input.value) {
        input.classList.add('filled');
        input.classList.remove('error');
        // Move to next
        if (idx < inputs.length - 1) inputs[idx + 1].focus();
      } else {
        input.classList.remove('filled');
      }

      otpStatus.textContent = '';
      otpStatus.className = 'otp-status';
      checkComplete();
    });

    input.addEventListener('keydown', e => {
      if (e.key === 'Backspace') {
        if (!input.value && idx > 0) {
          inputs[idx - 1].value = '';
          inputs[idx - 1].classList.remove('filled');
          inputs[idx - 1].focus();
        }
        checkComplete();
      }
      if (e.key === 'ArrowLeft' && idx > 0) inputs[idx - 1].focus();
      if (e.key === 'ArrowRight' && idx < inputs.length - 1) inputs[idx + 1].focus();
    });

    // Paste support
    input.addEventListener('paste', e => {
      e.preventDefault();
      const pasted = (e.clipboardData || window.clipboardData)
        .getData('text').replace(/\D/g, '').slice(0, 6);
      pasted.split('').forEach((char, i) => {
        if (inputs[i]) {
          inputs[i].value = char;
          inputs[i].classList.add('filled');
        }
      });
      const nextEmpty = inputs.findIndex(i => !i.value);
      if (nextEmpty !== -1) inputs[nextEmpty].focus();
      else inputs[inputs.length - 1].focus();
      checkComplete();
    });
  });

  // ── Verify submit ────────────────────────────────────────
  document.getElementById('otpForm').addEventListener('submit', () => {
    document.getElementById('codeHidden').value = getOTPValue();
    // const val = getOTPValue();
    // if (val.length < 6) return;

    // // Simulate: wrong code = anything NOT '123456'
    // if (val !== '123456') {
    //   setInputState('error');
    //   otpStatus.textContent = 'Kode salah atau sudah kedaluwarsa. Coba lagi.';
    //   otpStatus.className = 'otp-status error-msg';
    //   verifyBtn.disabled = true;
    //   // Clear after shake
    //   setTimeout(() => {
    //     inputs.forEach(i => { i.value = ''; i.classList.remove('error', 'filled'); });
    //     otpStatus.textContent = '';
    //     otpStatus.className = 'otp-status';
    //     inputs[0].focus();
    //   }, 1400);
    //   return;
    // }

    // Success
    // setInputState('success');
    // otpStatus.textContent = '✓ Kode benar! Memverifikasi...';
    // otpStatus.className = 'otp-status success-msg';
    // verifyBtn.disabled = true;
    // verifyBtn.textContent = 'Memverifikasi...';

    // setTimeout(() => {
    //   document.getElementById('successOverlay').classList.add('show');
    // }, 800);

    // // Auto redirect
    // setTimeout(() => {
    //   window.location.href = 'dashboard.html';
    // }, 4000);
  });

  // ── Countdown & Resend ───────────────────────────────────
  let countdown = 60;
  const countdownEl = document.getElementById('countdown');
  const resendBtn = document.getElementById('resendBtn');

  function startCountdown() {
    countdown = 60;
    resendBtn.disabled = true;
    countdownEl.closest('.resend-btn').innerHTML =
      `Kirim ulang (<span class="countdown-timer" id="countdown">${countdown}</span>)`;

    const timer = setInterval(() => {
      countdown--;
      const cd = document.getElementById('countdown');
      if (cd) cd.textContent = countdown;
      if (countdown <= 0) {
        clearInterval(timer);
        resendBtn.innerHTML = 'Kirim ulang kode';
        resendBtn.disabled = false;
      }
    }, 1000);
  }

  startCountdown();

  resendBtn.addEventListener('click', () => {
    if (resendBtn.disabled) return;
    otpStatus.textContent = '✉️ Kode baru sudah dikirim ke emailmu!';
    otpStatus.className = 'otp-status success-msg';
    inputs.forEach(i => { i.value = ''; i.classList.remove('filled', 'error', 'success'); });
    verifyBtn.disabled = true;
    inputs[0].focus();
    startCountdown();
    setTimeout(() => {
      otpStatus.textContent = '';
      otpStatus.className = 'otp-status';
    }, 3000);
  });

  // ── Change email ─────────────────────────────────────────
  document.getElementById('changeEmailBtn').addEventListener('click', e => {
    e.preventDefault();
    window.location.href = 'login.html';
  });
</script>

</body>
</html>
