<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Gateway;
use App\Models\RegisterForm;
use App\Models\GatewayCurrency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SetTenancyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set-tenancy-data {--tenant=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $tenantId = $this->option('tenant');

//            $gatewaysData = [
//                ['title' => 'Paypal', 'slug' => 'paypal', 'image' => 'assets/images/gateway-icon/paypal.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Stripe', 'slug' => 'stripe', 'image' => 'assets/images/gateway-icon/stripe.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Razorpay', 'slug' => 'razorpay', 'image' => 'assets/images/gateway-icon/razorpay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'INR', 'conversion_rate' => 80.00]]],
//                ['title' => 'Instamojo', 'slug' => 'instamojo', 'image' => 'assets/images/gateway-icon/instamojo.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'INR', 'conversion_rate' => 80.00]]],
//                ['title' => 'Mollie', 'slug' => 'mollie', 'image' => 'assets/images/gateway-icon/mollie.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Coinbase', 'slug' => 'coinbase', 'image' => 'assets/images/gateway-icon/coinbase.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'BTC', 'conversion_rate' => 464.00]]],
//                ['title' => 'Paystack', 'slug' => 'paystack', 'image' => 'assets/images/gateway-icon/paystack.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'NGN', 'conversion_rate' => 464.00]]],
//                ['title' => 'Sslcommerz', 'slug' => 'sslcommerz', 'image' => 'assets/images/gateway-icon/sslcommerz.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'BDT', 'conversion_rate' => 100.00]]],
//                ['title' => 'Flutterwave', 'slug' => 'flutterwave', 'image' => 'assets/images/gateway-icon/flutterwave.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'NGN', 'conversion_rate' => 464.00]]],
//                ['title' => 'Mercadopago', 'slug' => 'mercadopago', 'image' => 'assets/images/gateway-icon/mercadopago.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'BRL', 'conversion_rate' => 5.00]]],
//                ['title' => 'Binance', 'slug' => 'binance', 'image' => 'assets/images/gateway-icon/binance.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Paytm', 'slug' => 'paytm', 'image' => 'assets/images/gateway-icon/paytm.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'INR', 'conversion_rate' => 80.00]]],
//                ['title' => 'Payhere', 'slug' => 'payhere', 'image' => 'assets/images/gateway-icon/payhere.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'ZitoPay', 'slug' => 'zitopay', 'image' => 'assets/images/gateway-icon/zitopay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Iyzico', 'slug' => 'iyzico', 'image' => 'assets/images/gateway-icon/iyzico.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'BitPay', 'slug' => 'bitpay', 'image' => 'assets/images/gateway-icon/bitpay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'BTC', 'conversion_rate' => 1.00]]],
//                ['title' => 'Paymob', 'slug' => 'paymob', 'image' => 'assets/images/gateway-icon/paymob.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'ToyyibPay', 'slug' => 'toyyibpay', 'image' => 'assets/images/gateway-icon/toyyibpay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Voguepay', 'slug' => 'voguepay', 'image' => 'assets/images/gateway-icon/voguepay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Cinetpay', 'slug' => 'cinetpay', 'image' => 'assets/images/gateway-icon/cinetpay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Maxicash', 'slug' => 'maxicash', 'image' => 'assets/images/gateway-icon/maxicash.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Authorize.net', 'slug' => 'authorize', 'image' => 'assets/images/gateway-icon/authorize.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Alipay', 'slug' => 'alipay', 'image' => 'assets/images/gateway-icon/alipay.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//                ['title' => 'Bank', 'slug' => 'bank', 'image' => 'assets/images/gateway-icon/bank.png', 'status' => 1, 'mode' => 2, 'currencies' => [['currency' => 'USD', 'conversion_rate' => 1.00]]],
//            ];
//
//            foreach ($gatewaysData as $gatewayData) {
//                // Create the gateway with the tenant ID
//                $createdGateway = Gateway::create(array_merge($gatewayData, ['tenant_id' => $tenantId]));
//
//                // Insert each currency for this gateway
//                foreach ($gatewayData['currencies'] as $currencyData) {
//                    GatewayCurrency::create(array_merge($currencyData, ['gateway_id' => $createdGateway->id]));
//                }
//            }

            syncMissingGateway();

            $currenciesData = [
                ['currency_code' => 'USD', 'symbol' => '$', 'currency_placement' => 'before', 'current_currency' => 1],
                ['currency_code' => 'BDT', 'symbol' => '৳', 'currency_placement' => 'before', 'current_currency' => 0],
                ['currency_code' => 'INR', 'symbol' => '₹', 'currency_placement' => 'before', 'current_currency' => 0],
                ['currency_code' => 'GBP', 'symbol' => '£', 'currency_placement' => 'after', 'current_currency' => 0],
                ['currency_code' => 'MXN', 'symbol' => '$', 'currency_placement' => 'before', 'current_currency' => 0],
                ['currency_code' => 'SAR', 'symbol' => 'SR', 'currency_placement' => 'before', 'current_currency' => 0]
            ];

            foreach ($currenciesData as $currencyData) {
                Currency::create(array_merge($currencyData, ['tenant_id' => $tenantId]));
            }

            // Insert new register_form
            RegisterForm::create([
                'tenant_id' => $tenantId,
                'enable_batch' => 1,
                'enable_department' => 1,
                'enable_passing_year' => 1,
                'enable_role_number' => 1,
                'enable_attachment' => 1,
                'enable_date_of_birth' => 1,
                'enable_gender' => 1,
                'custom_fields' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage() . $exception->getFile() . $exception->getLine());
            return false;
        }

        return true;
    }
}
