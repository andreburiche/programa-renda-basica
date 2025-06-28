import type { Metadata } from "next";
import { SpeedInsights } from "@vercel/speed-insights/next";
import "./globals.css";

export const metadata: Metadata = {
  title: "Programa Renda Básica - Consulta de Benefícios",
  description: "Sistema de consulta de benefícios do Programa Renda Básica",
  keywords: "renda básica, benefícios, consulta, CPF",
  authors: [{ name: "Programa Renda Básica" }],
  viewport: "width=device-width, initial-scale=1",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="pt-BR">
      <body style={{ fontFamily: "system-ui, sans-serif" }}>
        {children}
        <SpeedInsights />
      </body>
    </html>
  );
}
