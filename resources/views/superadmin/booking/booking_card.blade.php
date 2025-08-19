<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking.com Review Card</title>
    <style>
        body {
            background: #f0f0f0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        .card {
            width: 300px;
            height: 550px;
            background: #003580; /* Booking.com Blue */
            border-radius: 20px;
            color: white;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .logo-circle {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .stars {
            font-size: 26px;
            margin: 15px 0;
            color: #FFD700;
        }

        .footer {
            font-size: 12px;
            margin-top: 15px;
            opacity: 0.8;
        }

        .qr {
            margin-top: 20px;
        }

        .print-btn {
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #003580;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* ✅ Force full color in print */
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
                background: #f0f0f0 !important;
            }

            .card {
                background: #003580 !important;
                color: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .logo-circle {
                background: white !important;
            }

            .stars {
                color: #FFD700 !important;
            }

            .footer {
                color: white !important;
            }

            .print-btn {
                display: none; /* Print me button hide ho jaye */
            }
        }
    </style>
</head>

<body>
    <!-- ✅ Print Button -->
    <button class="print-btn" onclick="printCard()">Print Booking Card</button>

    <!-- ✅ Booking Card -->
    <div class="card">
        <div class="logo-circle">
            <img src="{{ asset('assets/images/hotel.png') }}" alt="Hotel Logo" style="width:60px; height:60px;">
        </div>
        <p>{{ $booking->guest->name ?? 'Guest' }}</p>
        <div class="title">Booking Ref: {{ $booking->booking_reference }}</div>
        <div class="stars">
            @if($booking->payment_status == 'paid')
                ★★★★★
            @elseif($booking->payment_status == 'partial')
                ★★★★☆
            @else
                ★★★☆☆
            @endif
        </div>
        <p>Room: {{ $booking->room->room_number ?? 'N/A' }}</p>
        <p>Status: {{ ucfirst($booking->status) }}</p>
        <p>Check-in: {{ $booking->check_in }}</p>
        <p>Check-out: {{ $booking->check_out }}</p>

        {{-- ✅ QR Code --}}
        <div class="qr">
            {!! QrCode::size(120)->backgroundColor(255, 255, 255)->color(0, 53, 128)->generate($qrData) !!}
        </div>

        <div class="footer">Powered by GOFTECH</div>
    </div>

    <script>
        function printCard() {
            window.print();
        }
    </script>
</body>

</html>
